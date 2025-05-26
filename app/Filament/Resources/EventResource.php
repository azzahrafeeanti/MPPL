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

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Event Name'),
                
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->date()
                    ->label('Event Date'),

                Forms\Components\TimePicker::make('time')
                    ->required()
                    ->time()
                    ->label('Event Time'),

                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255)
                    ->label('Event Location'),

                Forms\Components\TextArea::make('description')
                    ->required()
                    ->maxLength(500)
                    ->label('Event Description'),

                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->required()
                    ->label('Event Photo'),

                Forms\Components\Select::make('ticket_id')
                    ->relationship('ticket', 'name') // Event belongsTo Ticket
                    ->label('Event Ticket')
                    ->required()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Event')
                    ->searchable() //kita bisa membuat fitur pencarian pada tabel tersebut berdasarkan dari nama
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
