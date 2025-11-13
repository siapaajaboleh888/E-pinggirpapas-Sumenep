<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'kategori',
        'harga',
        'satuan',
        'gambar',
        'status',
        'stok',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];

    // ========================================
    // RELATIONSHIPS
    // ========================================

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori', 'slug');
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'produk_id');
    }

    // ========================================
    // SCOPES
    // ========================================

    public function scopeActive($query)
    {
        return $query->where('status', 'tersedia');
    }

    public function scopeInStock($query)
    {
        return $query->where('stok', '>', 0);
    }

    // ========================================
    // ACCESSOR
    // ========================================

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            if (Storage::disk('public')->exists($this->gambar)) {
                return asset('storage/' . $this->gambar);
            }

            if (file_exists(public_path($this->gambar))) {
                return asset($this->gambar);
            }
        }
        return asset('assets/images/garam-default.jpg');
    }
}
