<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Story extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image_url',
        'author_id',
        'published_at',
        'category',
        'views',
        'slug',
    ];
    protected static function booted()
    {
        static::creating(function ($trending) {
            $trending->slug = Str::slug($trending->title); // Create slug from title when creating
        });

        static::updating(function ($trending) {
            $trending->slug = Str::slug($trending->title); // Update slug when title is updated
        });
    }  
}
