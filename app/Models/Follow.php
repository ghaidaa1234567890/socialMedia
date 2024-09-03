<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='follows';
    protected $fillable = ['follow_user_id','id_user'];
    
     
   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
