<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                ->required(),

                Forms\Components\TextInput::make('email')
                ->label('Email Address')
                ->email()
                ->maxLength(255)
                ->unique(ignoreRecord: true) // unique(ignoreRecord: true) maksudnya adalah mengabaikan record yang sedang diedit
                ->required(),

                Forms\Components\DateTimePicker::make('email_verified_at')
                ->label('Email Verified At')
                ->default(now()),

                Forms\Components\TextInput::make('password')
                ->label('Password')
                ->password()
                ->dehydrated(fn($state) => filled($state)) // Hanya menyimpan password jika diisi, Jika tidak menggunakan dehydrated(), maka field password akan selalu dikirimkan ke backend, bahkan jika pengguna tidak mengisi apa pun (misal pada saat edit profil)
                ->required(fn(Page $livewire): bool =>$livewire instanceof CreateRecord), // Saat membuat akun baru, pengguna harus memasukkan password, saat mengedit akun, pengguna tidak perlu memasukkan.

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([                //
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at') // Menampilkan tanggal dan waktu verifikasi email
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at') // Menampilkan tanggal dan waktu pembuatan akun
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
