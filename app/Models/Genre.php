<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Genre extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($genre) {
            $genre->slug = Str::slug($genre->name);
        });

        static::updating(function ($genre) {
            if ($genre->isDirty('name')) {
                $genre->slug = Str::slug($genre->name);
            }
        });
    }
}
