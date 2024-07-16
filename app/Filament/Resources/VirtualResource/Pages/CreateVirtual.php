<?php

namespace App\Filament\Resources\VirtualResource\Pages;

use App\Filament\Resources\VirtualResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVirtual extends CreateRecord
{
    protected static string $resource = VirtualResource::class;
}
