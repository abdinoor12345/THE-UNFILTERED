<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;
    protected $fillable = [ 'title', 'description', 'author', 'file_url', 'cover_image_url', 'published_date', 'status', ];
}
