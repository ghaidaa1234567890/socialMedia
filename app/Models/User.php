<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'c_password',
        'image',
        'description',
        
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function converstation()
    {
        return $this->hasOne('App\Models\Converstation');
    }

    public function post()
    {
     return $this->hasMany(Post::class);
 
    }
         
   public function replie()
   {
    return $this->hasMany(Replies::class);

   }
         
   public function comment()
   {
    return $this->hasMany(Comment::class);

   }

   public function follow()
   {
    return $this->hasMany(Follow::class);

   }
   
 
}
