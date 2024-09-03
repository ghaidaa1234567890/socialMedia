<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{     
    
    use HasFactory;
    protected $table='posts';
    
    public $timestamps=false;
     
   
    protected $fillable=[
        
        'description',
        'likes_count',
        'id_category',
        'user_id',
        'image',
        'annunciation',
    ];
    
   

    public function like()
    {
     return $this->hasMany(Like::class);
 
    }
   
   
    public function annun()
    {
     return $this->hasMany(Anunciation::class);
 
    }
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    


   
  
   public function comment()
   {
    return $this->hasMany(Image::class);

   }
   
   public function image()
   {
    return $this->hasMany(Image::class);

   }
  
 
   
   public function category()
   {
       return $this->belongsTo(Category::class);
   }
}
