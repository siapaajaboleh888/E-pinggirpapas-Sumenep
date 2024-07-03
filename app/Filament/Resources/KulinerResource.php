<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KulinerResource\Pages;
use App\Filament\Resources\KulinerResource\RelationManagers;
use App\Models\Kuliner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;

class KulinerResource extends Resource
{
    protected static ?string $model = Kuliner::class;
    protected static ?string $navigationLabel = 'Kuliner Desa';
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup = 'UMKM Desa Wisata';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(2048),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(2048),
                Forms\Components\TextInput::make('price'),
                // ->required()
                // ->maxLength(2048),
                Forms\Components\Textarea::make('text')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->required(),
                Forms\Components\TextInput::make('nomor_hp')
                    ->required()
                    ->maxLength(15),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('alamat')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->numeric()
                    ->prefix('Rp. '),
                // Tables\Columns\TextColumn::make('published_at')
                //     ->dateTime()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('nomor_hp')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('user.name')
                //     ->label('Nama Publisher')
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListKuliners::route('/'),
            // 'create' => Pages\CreateKuliner::route('/create'),
            // 'edit' => Pages\EditKuliner::route('/{record}/edit'),
        ];
    }
}
