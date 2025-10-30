<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk soft delete

class Pemesanan extends Model
{
    use HasFactory;
    // use SoftDeletes; // Uncomment jika ingin fitur soft delete

    /**
     * Nama tabel di database
     */
    protected $table = 'pemesanans';

    /**
     * Kolom yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'nomor_pesanan',
        'produk_id',
        'nama_pemesan',
        'email',
        'telepon',
        'alamat_pengiriman',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'catatan',
        'tanggal_pengiriman',
        'status'
    ];

    /**
     * Kolom yang TIDAK boleh diisi
     */
    protected $guarded = ['id'];

    /**
     * Mengubah tipe data kolom otomatis
     */
    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'jumlah' => 'integer',
        'tanggal_pengiriman' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Kolom yang disembunyikan saat JSON (untuk API)
     */
    protected $hidden = [];

    /**
     * Append custom attributes
     */
    protected $appends = ['formatted_total', 'status_badge', 'status_label'];

    /**
     * ========================================
     * RELATIONSHIPS (Relasi)
     * ========================================
     */

    /**
     * Relasi ke Produk
     * Pemesanan belongs to (punya) 1 Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    /**
     * Relasi ke User (Jika ada sistem login)
     * Uncomment jika ada relasi ke user
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * ========================================
     * ACCESSORS (Getter)
     * ========================================
     */

    /**
     * Format total harga dengan Rupiah
     * Usage: $pemesanan->formatted_total
     */
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    /**
     * Format harga satuan dengan Rupiah
     * Usage: $pemesanan->formatted_price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga_satuan, 0, ',', '.');
    }

    /**
     * Warna badge untuk status
     * Usage: $pemesanan->status_badge
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'confirmed' => 'info',
            'processing' => 'primary',
            'shipped' => 'success',
            'delivered' => 'success',
            'cancelled' => 'danger'
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    /**
     * Label status dalam Bahasa Indonesia
     * Usage: $pemesanan->status_label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Sedang Diproses',
            'shipped' => 'Sedang Dikirim',
            'delivered' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        return $labels[$this->status] ?? 'Status Tidak Dikenal';
    }

    /**
     * Format tanggal pengiriman
     * Usage: $pemesanan->formatted_date
     */
    public function getFormattedDateAttribute()
    {
        return $this->tanggal_pengiriman
            ? $this->tanggal_pengiriman->format('d F Y')
            : '-';
    }

    /**
     * Nama produk (shortcut)
     * Usage: $pemesanan->product_name
     */
    public function getProductNameAttribute()
    {
        return $this->produk?->name ?? 'Produk tidak ditemukan';
    }

    /**
     * ========================================
     * SCOPES (Query Helpers)
     * ========================================
     */

    /**
     * Scope untuk filter berdasarkan status
     * Usage: Pemesanan::status('pending')->get()
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk pesanan pending
     * Usage: Pemesanan::pending()->get()
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope untuk pesanan confirmed
     * Usage: Pemesanan::confirmed()->get()
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope untuk pesanan aktif (bukan cancelled/delivered)
     * Usage: Pemesanan::active()->get()
     */
    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['cancelled', 'delivered']);
    }

    /**
     * Scope untuk pesanan hari ini
     * Usage: Pemesanan::today()->get()
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope untuk pesanan bulan ini
     * Usage: Pemesanan::thisMonth()->get()
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    /**
     * Scope untuk search berdasarkan nomor pesanan atau nama
     * Usage: Pemesanan::search('PO-')->get()
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('nomor_pesanan', 'like', "%{$term}%")
                ->orWhere('nama_pemesan', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%")
                ->orWhere('telepon', 'like', "%{$term}%");
        });
    }

    /**
     * ========================================
     * MUTATORS (Setter)
     * ========================================
     */

    /**
     * Auto format telepon (opsional)
     * Menghapus karakter selain angka
     */
    public function setTeleponAttribute($value)
    {
        $this->attributes['telepon'] = preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * Auto lowercase email
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * ========================================
     * METHODS (Custom Functions)
     * ========================================
     */

    /**
     * Cek apakah pesanan bisa dibatalkan
     */
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'confirmed']);
    }

    /**
     * Update status pesanan
     */
    public function updateStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();

        return $this;
    }

    /**
     * Konfirmasi pesanan
     */
    public function confirm()
    {
        return $this->updateStatus('confirmed');
    }

    /**
     * Batalkan pesanan
     */
    public function cancel()
    {
        if ($this->canBeCancelled()) {
            return $this->updateStatus('cancelled');
        }

        return false;
    }

    /**
     * Generate nomor pesanan otomatis
     */
    public static function generateOrderNumber()
    {
        $prefix = 'PO';
        $date = date('Ymd');
        $random = strtoupper(substr(uniqid(), -6));

        return "{$prefix}-{$date}-{$random}";
    }

    /**
     * ========================================
     * BOOT METHOD
     * ========================================
     */

    /**
     * Boot function untuk auto-generate nomor pesanan
     */
    protected static function boot()
    {
        parent::boot();

        // Auto generate nomor pesanan saat create
        static::creating(function ($pemesanan) {
            if (empty($pemesanan->nomor_pesanan)) {
                $pemesanan->nomor_pesanan = self::generateOrderNumber();
            }

            // Auto set status default
            if (empty($pemesanan->status)) {
                $pemesanan->status = 'pending';
            }
        });

        // Log activity saat update status (opsional)
        static::updating(function ($pemesanan) {
            if ($pemesanan->isDirty('status')) {
                // Log perubahan status di sini
                // \Log::info("Order {$pemesanan->nomor_pesanan} status changed to {$pemesanan->status}");
            }
        });
    }
}
