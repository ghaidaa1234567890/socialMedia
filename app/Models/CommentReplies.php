<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReplies extends Model
{
    use HasFactory;
    protected $table='comment_riplies';
    protected $fillable = ['id_replie','id_comment'];
  

}
