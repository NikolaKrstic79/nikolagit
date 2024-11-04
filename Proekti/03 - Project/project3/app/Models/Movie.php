<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'year',
        'director',
        'writer',
        'stars',
        'trailer_url',
        'image_url',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        $ratings = $this->ratings;

        if ($ratings->isEmpty()) {
            return 0;
        }

        return $ratings->avg('rating');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

