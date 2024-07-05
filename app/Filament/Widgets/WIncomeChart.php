<?php

namespace App\Filament\Widgets;

use App\Models\Keuangan;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class WIncomeChart extends ChartWidget
{
    protected static ?string $heading = 'Pemasukan';
    protected static string $color = 'success';

    protected function getData(): array
    {
        $data = Trend::query(Keuangan::income())
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay('tanggal')
            ->sum('jumlah');

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan Perhari',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('d-m-Y')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
