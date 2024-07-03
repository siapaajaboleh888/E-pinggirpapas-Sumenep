<?php

namespace App\Filament\Resources\KulinerResource\Pages;

use App\Filament\Resources\KulinerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKuliners extends ListRecords
{
    protected static string $resource = KulinerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
