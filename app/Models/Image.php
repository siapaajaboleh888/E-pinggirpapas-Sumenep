<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'kuliner_id',
        'image_path',
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the kuliner associated with the image.
     */
    public function kuliner()
    {
        return $this->belongsTo(Kuliner::class);
    }
}
