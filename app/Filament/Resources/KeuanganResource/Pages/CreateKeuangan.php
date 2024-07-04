<?php

namespace App\Filament\Resources\KeuanganResource\Pages;

use App\Filament\Resources\KeuanganResource;
use App\Models\Keuangan;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateKeuangan extends CreateRecord
{
    protected static string $resource = KeuanganResource::class;
}
