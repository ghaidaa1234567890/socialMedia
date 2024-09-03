<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table='chats';
    protected $fillable = ['converstat_id','message','  user_second_i'
    ,'image'];
    public $timestamps=false;
     
    public function converstation()
   {
       return $this->belongsTo(Converstation::class);
   }
}
