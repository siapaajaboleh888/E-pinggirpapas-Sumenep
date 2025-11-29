<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'phone',
        'jam_operasional',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope hanya yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Ambil nomor WhatsApp aktif pertama (untuk front-end).
     */
    public static function getDefault(): ?self
    {
        return static::query()
            ->active()
            ->orderByDesc('created_at')
            ->first();
    }

    /**
     * Nomor dalam format internasional (62...).
     */
    public function getFormattedPhoneAttribute(): string
    {
        $phone = preg_replace('/[^0-9+]/', '', (string) $this->phone);

        // Jika sudah mulai dengan 62 atau +62 anggap valid
        if (str_starts_with($phone, '62')) {
            return $phone;
        }

        if (str_starts_with($phone, '+62')) {
            return ltrim($phone, '+');
        }

        // Jika mulai 0, ganti jadi 62
        $phone = ltrim($phone, '0');

        return '62' . $phone;
    }

    /**
     * Link wa.me siap pakai.
     */
    public function getWhatsappLinkAttribute(): string
    {
        $message = urlencode('Halo, saya tertarik dengan informasi di E-Pinggirpapas-Sumenep');

        return 'https://wa.me/' . $this->formatted_phone . '?text=' . $message;
    }
}
