<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virtual extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'link',
        'thumbnail',
        'is_active',
        'order',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail)) {
            return $this->thumbnail;
        }

        // Auto-generate YouTube thumbnail if possible
        if (!empty($this->link)) {
            $videoId = null;

            // Pattern for watch URL: https://www.youtube.com/watch?v=ID
            if (preg_match('~v=([\w-]{6,})~', $this->link, $matches)) {
                $videoId = $matches[1];
            }

            // Pattern for short youtu.be/ID
            if (!$videoId && preg_match('~youtu\.be/([\w-]{6,})~', $this->link, $matches)) {
                $videoId = $matches[1];
            }

            // Pattern for embed URL: https://www.youtube.com/embed/ID
            if (!$videoId && preg_match('~embed/([\w-]{6,})~', $this->link, $matches)) {
                $videoId = $matches[1];
            }

            if ($videoId) {
                return "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
            }
        }

        return asset('assets/images/virtual-tour.jpg');
    }
}
