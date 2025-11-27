<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VirtualResource\Pages;
use App\Filament\Resources\VirtualResource\RelationManagers;
use App\Models\Virtual;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VirtualResource extends Resource
{
    protected static ?string $model = Virtual::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationLabel = 'Link Virtual Tour';
    protected static ?string $navigationGroup = 'Blog & Virtual Tour';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3),

                Forms\Components\TextInput::make('link')
                    ->label('Link YouTube / Iframe')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('thumbnail')
                    ->label('URL Thumbnail (opsional)')
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),

                Forms\Components\TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('link')
                    ->label('Link')
                    ->limit(30),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVirtuals::route('/'),
            // 'create' => Pages\CreateVirtual::route('/create'),
            // 'edit' => Pages\EditVirtual::route('/{record}/edit'),
        ];
    }
}
