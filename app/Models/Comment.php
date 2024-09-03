<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable = ['id_user_comment','id_post','text','image'];
    public $timestamps=false;
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    
  public function repie()
  {
     
          return $this->belongsToMany(Replies::class, 'comment_riplies');
      }

}
