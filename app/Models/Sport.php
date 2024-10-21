<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sport extends Model
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
        'category',
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
            public function user(){
        return $this->belongsTo(User::class,'user_id');
    }  
    public function getRelatedPosts()
{
    // Extract keywords from the current post's title and description
    $keywords = explode(' ', $this->title . ' ' . $this->description);

    // Limit keywords to a certain number, e.g., 5, to avoid too many matches
    $keywords = array_slice($keywords, 0, 5);

    // Ensure we are only considering valid keywords (filter out very common or short words)
    $keywords = array_filter($keywords, function($keyword) {
        return strlen($keyword) > 3; // Exclude short/common words
    });

    // Find related posts based on matching title or description with the filtered keywords
    $relatedPosts = Sport::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('title', 'LIKE', "%{$keyword}%")
                      ->orWhere('description', 'LIKE', "%{$keyword}%");
            }
        })
        ->where('id', '!=', $this->id) // Exclude the current post
        ->take(5) // Limit to 5 related posts
        ->get();

    // Return related posts only if there are matches; otherwise, return an empty collection
    return $relatedPosts->isNotEmpty() ? $relatedPosts : collect();
}
}
