<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
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
