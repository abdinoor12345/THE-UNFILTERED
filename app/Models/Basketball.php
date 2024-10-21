<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Basketball extends Model
{
    use HasFactory;
    protected  $fillable=[
        'title' ,
        'description' ,
        'content',
        'image_url',
        'important_link',
        'slug',
        'user_id',
        'link1',
        'link2',
        'link3',
        'link_text1',
        'link_text2',
        'link_text3',
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
