<?php

namespace App\Filament\Resources\VirtualResource\Pages;

use App\Filament\Resources\VirtualResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVirtuals extends ListRecords
{
    protected static string $resource = VirtualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
