<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'stock',
        'image_url',
        'type',
        'size',
        'brand',
        'is_available',
    ];
    
}
