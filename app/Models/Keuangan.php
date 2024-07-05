<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tanggal',
        'keterangan',
        'type',
        'jumlah',
    ];

    protected $casts = [
        'tanggal' => 'date:d-m-Y',
    ];

    public static $types = [
        'income' => 'Income',
        'expense' => 'Expense',
    ];

    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }
}
