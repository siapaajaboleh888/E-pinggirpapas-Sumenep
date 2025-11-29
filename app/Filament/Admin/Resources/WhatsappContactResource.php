<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WhatsappContactResource\Pages;
use App\Models\WhatsappContact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WhatsappContactResource extends Resource
{
    protected static ?string $model = WhatsappContact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationLabel = 'Nomor WhatsApp';
    protected static ?string $navigationGroup = 'Kontak & Komunikasi';
    protected static ?int $navigationSort = 10;

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')
                    ->label('Label')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label('Nomor WhatsApp')
                    ->required()
                    ->maxLength(50)
                    ->helperText('Contoh: 081234567890 atau 6281234567890')
                    ->rule('regex:/^[0-9+ ]+$/'),

                Forms\Components\TextInput::make('jam_operasional')
                    ->label('Jam Operasional')
                    ->maxLength(255),

                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan Tambahan')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Label')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Nomor WA')
                    ->searchable(),

                Tables\Columns\TextColumn::make('jam_operasional')
                    ->label('Jam Operasional')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->label('Dibuat')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWhatsappContacts::route('/'),
            'create' => Pages\CreateWhatsappContact::route('/create'),
            'edit' => Pages\EditWhatsappContact::route('/{record}/edit'),
        ];
    }
}
