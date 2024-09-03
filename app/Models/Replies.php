<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    use HasFactory;
    protected $table='replies';
    protected $fillable = ['id_user_Replie','text','image'];
    public $timestamps=false;
    
    
   public function user()
   {
       return $this->belongsTo(User::class);
   }
  
    
    public function comment()
    {
            return $this->belongsToMany(Comment::class, 'comment_riplies');
        
    }
}
