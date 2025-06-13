<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Ticket;
use App\Models\EventPhoto;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;



class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Details')
                ->schema([

                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true) // live(onBlur: true) akan mengupdate slug secara otomatis ketika field name diubah
                        ->afterStateUpdated(function (string $operation, $state, Set $set) {
                            if($operation !== 'create'){
                                return; // Jika operasi bukan 'create', maka tidak perlu mengupdate slug
                            }
                            $set ('slug', Str::slug($state)); // Str::slug($state) digunakan untuk membuat slug dari nama event
                        }),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->disabled()
                        ->dehydrated() // digunakan untuk menghindari pengiriman data slug ke backend saat form disubmit
                        ->unique(Event::class, 'slug', ignoreRecord: true), // ignoreRecord: true digunakan untuk mengabaikan record yang sedang diedit

                    Forms\Components\TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->prefix('IDR')
                        ->placeholder('Masukkan harga tiket'),

                    Forms\Components\FileUpload::make('photo')
                        ->image()
                        ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'])
                        ->required(),
                    
                ]),

                Fieldset::make('Additional')
                ->schema([

                    Forms\Components\TextInput::make('location')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\DatePicker::make('date')
                        ->required(),

                    Forms\Components\TimePicker::make('time')
                        ->required(),

                    Forms\Components\TextInput::make('stock')
                        ->required()
                        ->numeric()
                        ->prefix('Qty.')
                        ->placeholder('Masukkan jumlah tiket'),

                    Forms\Components\TextArea::make('description')
                        ->required()
                        ->maxLength(500),

                    Forms\Components\Select::make('ticket_id')
                        ->relationship('ticket', 'name') // Event belongsTo Ticket
                        ->searchable()
                        ->preload()
                        ->required(),
                ]),

                Fieldset::make('Status')
                ->schema([
                    Toggle::make('in_stock')
                    ->required()
                    ->default(true), // maksud dari default(true) adalah ketika membuat event baru, maka status in_stock akan otomatis aktif

                    Toggle::make('is_active')
                    ->required()
                    ->default(true),
                ]),
            ]);
        
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                ->searchable() //kita bisa membuat fitur pencarian pada tabel tersebut berdasarkan dari nama
                ->sortable(),

                Tables\Columns\TextColumn::make('ticket.name')
                ->searchable()
                ->sortable(),

                Tables\Columns\ImageColumn::make('photo')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('price')
                ->money('IDR', true) // Format harga dengan mata uang IDR
                ->searchable()
                ->sortable(),

                Tables\Columns\IconColumn::make('in_stock')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('danger'),

                Tables\Columns\IconColumn::make('is_active')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('danger'),


                Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true), // Toggleable untuk menampilkan atau menyembunyikan kolom ini
                
                Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
                SelectFilter::make('ticket_id')
                    ->label('Ticket')
                    ->relationship('ticket', 'name'),
                    
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
