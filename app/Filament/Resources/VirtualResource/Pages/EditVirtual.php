<?php

namespace App\Filament\Resources\VirtualResource\Pages;

use App\Filament\Resources\VirtualResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVirtual extends EditRecord
{
    protected static string $resource = VirtualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
