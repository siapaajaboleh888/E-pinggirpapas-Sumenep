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
                Forms\Components\TextInput::make('link')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('link')
                    ->label('Virtual Tour'),
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
