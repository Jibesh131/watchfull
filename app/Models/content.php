<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    protected $casts = [
        'stars' => 'array',
        'genres' => 'array',
        'directors' => 'array',
        'writers' => 'array',
        'producers' => 'array',
    ];

    public function scopeStatus($query, $status = 'published')
    {
        return $query->where('status', $status);
    }

    public function scopeGenre($query, $genre = null)
    {
        if (!$genre) {
            return $query; // no filter
        }
        return $query->where('genre', $genre);
    }
}
