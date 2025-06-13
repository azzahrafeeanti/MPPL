<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use App\Models\Event;
use App\Models\Promo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Component\Wizard;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;


use function Livewire\Volt\boot;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Wizard::make([

                    Forms\Components\Wizard\Step::make('Product and Price')
                        ->schema([

                            Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('event_id')
                                ->relationship('event', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->live()
                                ->afterStateUpdated(function($state, callable $get, callable $set) { // untuk membuat inputan lebih interaktif
                                    $event = Event::find($state);
                                    $price = $event ? $event->price : 0; // Ambil harga dari event yang dipilih
                                    $quantity = $get('quantity') ?? 1; // Ambil nilai quantity jika sudah ada
                                    $subTotalAmount = $price * $quantity; // Hitung sub total

                                    $set('price', $price);
                                    $set('sub_total_amount', $subTotalAmount);

                                    $discount = $get ('discount_amount') ?? 0;
                                    $grandTotalAmount = $subTotalAmount - $discount;
                                    $set('grand_total_amount', $grandTotalAmount);
                                }),

                            
                                Forms\Components\TextInput::make('quantity')
                                ->numeric()
                                ->required()
                                ->prefix('Qty')
                                ->live()
                                ->afterStateUpdated(function($state, callable $get, callable $set) { // get untuk mendapatkan sebuah variable yang udah diatur dimanapun, set untuk mengeset sebuah variable
                                    $price = $get('price');
                                    $quantity = $state;
                                    $subTotalAmount = $price * $quantity; // akan mengubah data harga lagi ketika quantity ditambah atau dikurangi
                                    $set('sub_total_amount', $subTotalAmount);
                                    $discount = $get('discount_amount') ?? 0;
                                    $grandTotalAmount = $subTotalAmount - $discount;
                                    $set('grand_total_amount', $grandTotalAmount);
                                }),

                                Forms\Components\TextInput::make('sub_total_amount')
                                ->required()
                                ->readOnly()
                                ->numeric()
                                ->prefix('Rp'),

                                Forms\Components\TextInput::make('grand_total_amount')
                                ->required()
                                ->readOnly()
                                ->numeric()
                                ->prefix('Rp'),
                            ]),
                                                        
                    ]),

                    // State baru untuk mengisi data customer
                    Forms\Components\Wizard\Step::make('Customer Information')
                        ->schema([

                            Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(255),

                                Forms\Components\TextInput::make('NIK')
                                ->required()
                                ->maxLength(16),

                                Forms\Components\Select::make('gender')
                                ->options([
                                    'laki-laki' => 'laki-laki',
                                    'perempuan' => 'perempuan',

                                ]),

                                TextInput::make('social_media_account')
                                ->label('Akun Media Sosial')
                                ->required()
                                ->maxLength(255),

                                Radio::make('agree_handbook')
                                    ->label('Bersedia Menaati Handbook?')
                                    ->options([
                                        true => 'YA',
                                        false => 'TIDAK',
                                    ])
                                    ->boolean() // Penting untuk mengikat ke boolean
                                    ->required(),
                                ]),
                    ]),

                    Forms\Components\Wizard\Step::make('Payment Information')
                        ->schema([
                            Forms\Components\TextInput::make('booking_trx_id')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->default(fn () => Transaction::generateUniqueTrxId())
                            ->disabled()
                            ->dehydrated(),

                            Forms\Components\ToggleButtons::make('is_paid')
                            ->label('Apakah sudah dibayar?')
                            ->boolean()
                            ->grouped()
                            ->icons([
                                true => 'heroicon-o-pencil',
                                false => 'heroicon-o-clock',
                            ])
                            ->required(),

                            Forms\Components\FileUpload::make('proof')
                            ->image()
                            ->required(),

                            Forms\Components\DatePicker::make('date')
                            ->date()
                            ->required(),
                                
                        ]),
                        
                ])
                ->columnSpan('full') // untuk mengatur lebar wizard, bisa diubah sesuai kebutuhan
                ->columns(1) // untuk mengatur jumlah kolom dalam wizard
                ->skippable() // untuk mengatur apakah wizard bisa dilewati atau tidak
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\ImageColumn::make('event.photo'),

                Tables\Columns\TextColumn::make('name')
                ->searchable(),

                Tables\Columns\TextColumn::make('booking_trx_id')
                ->searchable(),

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
                SelectFilter::make('event_id')
                    ->label('event')
                    ->relationship('event', 'name'),
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

    public static function getNavigationBadge(): ?string {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null { // string | array | null artinya bisa mengembalikan string, array, atau null
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
