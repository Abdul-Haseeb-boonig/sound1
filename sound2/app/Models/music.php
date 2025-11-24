<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class music extends Model
{
     protected $fillable = [
        'title', 'description', 'file_path', 'image_path',
        'year', 'artist', 'album', 'genre', 'language', 'is_new'
    ];

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
