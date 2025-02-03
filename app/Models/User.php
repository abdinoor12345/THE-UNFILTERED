<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Trending;
use App\Models\Top_Story;
use App\Models\Opinion;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function trendingNews(){
        return $this->hasMany(Trending::class,'user_id');
    }
    public function top_stories(){
        return $this->hasMany(Top_Story::class,'user_id');
    }
    public function opinion(){
        return $this->hasMany(Opinion::class,'user_id');
    }
    public function sport(){
        return $this->hasMany(Sport::class,'user_id');
    }
    public function technology(){
        return $this->hasMany(Technology::class,'user_id');
    }
    public function business(){
        return $this->hasMany(Business::class,'user_id');
    }
    public function sponsered(){
        return $this->hasMany(Sponsered::class,'user_id');
    }
}
