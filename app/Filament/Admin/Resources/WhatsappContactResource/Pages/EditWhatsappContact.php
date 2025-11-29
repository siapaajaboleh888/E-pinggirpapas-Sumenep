<?php

namespace App\Filament\Admin\Resources\WhatsappContactResource\Pages;

use App\Filament\Admin\Resources\WhatsappContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhatsappContact extends EditRecord
{
    protected static string $resource = WhatsappContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
