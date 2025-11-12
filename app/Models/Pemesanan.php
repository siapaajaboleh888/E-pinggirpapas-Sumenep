<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';

    // ✅ BENAR: Tidak ada 'tanggal_pemesanan' di fillable
    // Laravel otomatis handle created_at & updated_at
    protected $fillable = [
        'nomor_pesanan',
        'produk_id',
        'nama_produk',
        'nama_pemesan',
        'email',
        'telepon',
        'alamat_pengiriman',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'status',
        'catatan',
        'catatan_admin',
        'tanggal_pengiriman',
        // Payment fields
        'payment_method',
        'payment_channel',
        'payment_status',
        'payment_proof',
        'paid_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tanggal_pengiriman' => 'datetime',
        'paid_at' => 'datetime',
        'harga_satuan' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];

    // ========================================
    // RELATIONSHIPS
    // ========================================

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // ========================================
    // AUTO-GENERATE NOMOR PESANAN
    // ========================================

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->nomor_pesanan)) {
                $model->nomor_pesanan = 'KGR-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }

            if (empty($model->status)) {
                $model->status = 'pending';
            }

            // ✅ BENAR: Tidak set tanggal_pemesanan
            // Laravel otomatis mengisi created_at saat insert
        });
    }

    // ========================================
    // ACCESSOR untuk backward compatibility
    // ========================================

    /**
     * ✅ Accessor untuk 'tanggal_pemesanan' yang return created_at
     * Ini untuk backward compatibility jika ada view yang masih pakai $pemesanan->tanggal_pemesanan
     */
    public function getTanggalPemesananAttribute()
    {
        return $this->created_at;
    }

    // ========================================
    // SCOPES
    // ========================================

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopeShipped($query)
    {
        return $query->where('status', 'shipped');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('nomor_pesanan', 'LIKE', "%{$term}%")
                ->orWhere('nama_pemesan', 'LIKE', "%{$term}%")
                ->orWhere('email', 'LIKE', "%{$term}%")
                ->orWhere('telepon', 'LIKE', "%{$term}%");
        });
    }

    // ========================================
    // STATUS UPDATE METHODS
    // ========================================

    public function confirm()
    {
        $this->update(['status' => 'confirmed']);
        return $this;
    }

    public function process()
    {
        $this->update(['status' => 'processing']);
        return $this;
    }

    public function ship()
    {
        $this->update([
            'status' => 'shipped',
            'tanggal_pengiriman' => now()
        ]);
        return $this;
    }

    public function deliver()
    {
        $this->update(['status' => 'delivered']);
        return $this;
    }

    public function cancel()
    {
        $this->update(['status' => 'cancelled']);
        return $this;
    }

    // ========================================
    // HELPERS
    // ========================================

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>',
            'confirmed' => '<span class="badge bg-info">Dikonfirmasi</span>',
            'processing' => '<span class="badge bg-primary">Diproses</span>',
            'shipped' => '<span class="badge bg-secondary">Dikirim</span>',
            'delivered' => '<span class="badge bg-success">Selesai</span>',
            'cancelled' => '<span class="badge bg-danger">Dibatalkan</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">' . ucfirst($this->status) . '</span>';
    }

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y H:i');
    }

    // ========================================
    // PAYMENT HELPERS
    // ========================================

    public function getPaymentMethodNameAttribute()
    {
        $methods = [
            'bank_transfer' => 'Transfer Bank',
            'e_wallet' => 'E-Wallet',
            'cod' => 'COD (Cash on Delivery)',
        ];
        return $methods[$this->payment_method] ?? '-';
    }

    public function getPaymentChannelNameAttribute()
    {
        $channels = [
            'bca' => 'BCA',
            'bni' => 'BNI',
            'mandiri' => 'Mandiri',
            'bri' => 'BRI',
            'cimb' => 'CIMB Niaga',
            'dana' => 'DANA',
            'gopay' => 'GoPay',
            'ovo' => 'OVO',
            'cod' => 'COD',
        ];
        return $channels[$this->payment_channel] ?? '-';
    }

    public function getPaymentStatusBadgeAttribute()
    {
        $badges = [
            'unpaid' => '<span class="badge bg-danger">Belum Bayar</span>',
            'pending' => '<span class="badge bg-warning text-dark">Menunggu Verifikasi</span>',
            'paid' => '<span class="badge bg-success">Sudah Bayar</span>',
        ];
        return $badges[$this->payment_status] ?? '<span class="badge bg-secondary">-</span>';
    }

    public function markAsPaid()
    {
        $this->update([
            'payment_status' => 'paid',
            'paid_at' => now()
        ]);
        return $this;
    }

    public function markAsPending()
    {
        $this->update(['payment_status' => 'pending']);
        return $this;
    }
}
