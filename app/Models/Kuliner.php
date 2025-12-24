<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Kuliner extends Model
{
    use HasFactory;

    protected $table = 'kuliners';

    protected $fillable = [
        'title',
        'text',
        'price',
        'image',
        'alamat',
        'nomor_hp',
        'published_at',
        'satuan',
        'user_id',
    ];

    protected $casts = [
        'price' => 'integer',
        'published_at' => 'datetime',
    ];

    /**
     * ✅ OPTIMIZED: Hanya append yang benar-benar digunakan
     */
    protected $appends = ['nama', 'deskripsi', 'harga', 'satuan', 'foto', 'image_url'];

    // ============================================
    // ACCESSOR UNTUK KOMPATIBILITAS VIEW
    // ============================================

    /**
     * Mapping: title -> nama
     */
    public function getNamaAttribute()
    {
        return $this->attributes['title'] ?? 'Garam Premium';
    }

    /**
     * Mapping: text -> deskripsi
     */
    public function getDeskripsiAttribute()
    {
        return $this->attributes['text'] ?? 'Garam berkualitas tinggi dari petambak lokal';
    }

    /**
     * Mapping: price -> harga
     */
    public function getHargaAttribute()
    {
        return $this->attributes['price'] ?? 0;
    }

    /**
     * Default satuan
     */
    public function getSatuanAttribute()
    {
        return $this->attributes['satuan'] ?? '500 gram';
    }

    /**
     * Alias dari image
     */
    public function getFotoAttribute()
    {
        return $this->getImageUrlAttribute();
    }

    /**
     * ✅ CRITICAL FIX: Intelligent Image URL Handler
     * Prioritas:
     * 1. Cek jika URL lengkap (http/https)
     * 2. Cek di storage/kuliners/
     * 3. Cek di public/assets/images/
     * 4. Fallback ke default image
     */
    public function getImageUrlAttribute()
    {
        $image = $this->attributes['image'] ?? '';

        // Jika kosong, return default
        if (empty($image)) {
            return asset('assets/images/garam-default.jpg');
        }

        // Jika sudah URL lengkap
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        // Cek di storage (untuk upload dari admin)
        if (Storage::disk('public')->exists('kuliners/' . $image)) {
            return asset('storage/kuliners/' . $image);
        }

        // Cek di public/assets/images (untuk gambar statis)
        $publicPath = public_path('assets/images/' . $image);
        if (file_exists($publicPath)) {
            return asset('assets/images/' . $image);
        }

        // Fallback
        return asset('assets/images/garam-default.jpg');
    }

    /**
     * Format harga Indonesia
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * WhatsApp Link Generator
     */
    public function getWhatsappLinkAttribute()
    {
        $phone = $this->nomor_hp ?? '085334159328';
        $cleanPhone = ltrim($phone, '0');
        $message = urlencode("Halo, saya tertarik dengan {$this->nama}");

        return "https://wa.me/62{$cleanPhone}?text={$message}";
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Admin KUGAR',
            'email' => 'admin@kugar.com'
        ]);
    }

    // ============================================
    // SCOPES (untuk query optimization)
    // ============================================

    /**
     * Scope untuk produk published
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope untuk produk terbaru
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
