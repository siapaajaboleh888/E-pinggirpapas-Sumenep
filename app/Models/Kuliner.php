<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuliner extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'title',
        'alamat',
        'price',
        'text',
        'published_at',
        'nomor_hp',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
