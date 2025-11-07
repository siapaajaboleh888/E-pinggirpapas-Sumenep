<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans'; // atau 'pemesanan' sesuai database Anda

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
        'status',
        'catatan',
        'tanggal_pemesanan',
        'tanggal_pengiriman',
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
        'tanggal_pengiriman' => 'datetime',
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
                $model->nomor_pesanan = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }

            if (empty($model->status)) {
                $model->status = 'pending';
            }

            if (empty($model->tanggal_pemesanan)) {
                $model->tanggal_pemesanan = now();
            }
        });
    }

    // ========================================
    // SCOPES - QUERY HELPERS
    // ========================================

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
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
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
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

    public function updateStatus($status)
    {
        $this->update(['status' => $status]);
        return $this;
    }

    // ========================================
    // ACCESSOR & MUTATOR
    // ========================================

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'confirmed' => '<span class="badge bg-info">Dikonfirmasi</span>',
            'processing' => '<span class="badge bg-primary">Diproses</span>',
            'shipped' => '<span class="badge bg-secondary">Dikirim</span>',
            'delivered' => '<span class="badge bg-success">Selesai</span>',
            'cancelled' => '<span class="badge bg-danger">Dibatalkan</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">' . $this->status . '</span>';
    }

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y H:i');
    }
}
