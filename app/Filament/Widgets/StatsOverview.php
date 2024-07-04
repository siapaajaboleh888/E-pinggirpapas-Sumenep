<?php

namespace App\Filament\Widgets;

use App\Models\Keuangan;
use App\Models\Kuliner;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pemasukan = Keuangan::income()->sum('jumlah');
        $pengeluaran = Keuangan::expense()->sum('jumlah');
        $saldo = $pemasukan - $pengeluaran;
        return [
            Stat::make('Total Pemasukan', 'Rp ' . number_format($pemasukan, 0, ',', '.'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($pengeluaran, 0, ',', '.'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
            Stat::make('Total Saldo', 'Rp ' . number_format($saldo, 0, ',', '.'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning'),
        ];
    }

    // Stat::make('Users', User::query()->count())
    //     ->description('Jumlah users website')
    //     ->descriptionIcon('heroicon-m-arrow-trending-up')
    //     ->chart([7, 2, 10, 3, 15, 4, 17])
    //     ->color('success'),
    // Stat::make('Kuliners', Kuliner::query()->count())
    //     ->description('Jumlah UMKM Desa')
    //     ->descriptionIcon('heroicon-m-arrow-trending-up')
    //     ->chart([7, 2, 10, 3, 15, 4, 17])
    //     ->color('primary'),
    // Stat::make('Posts', Post::query()->count())
    //     ->description('Jumlah Post')
    //     ->descriptionIcon('heroicon-m-arrow-trending-up')
    //     ->chart([7, 2, 10, 3, 15, 4, 17])
    //     ->color('warning'),



}
