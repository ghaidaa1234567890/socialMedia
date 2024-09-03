<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Annunciation;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnnunciationRequest;
use App\Http\Requests\UpdateAnnunciationRequest;

class AnnunciationController extends Controller
{
    public function addannun($id){
        $user_id = Auth::user()->id;
       // $user_id=1;
        $annun = Annunciation::query()->where('user_id','=',$user_id)
        ->where('post_id','=',$id);
        $post =Post::find($id);
        if($annun->get()->isNotEmpty()) {
          $post->annunciation--;
          $post->save();
          $annun->delete();
        }
       
        
        else {
          $annun = Annunciation::query()->create([
            'user_id' => $user_id,
            'post_id' => $id
          ]);
          $annun->post->annunciation++;
          $annun->post->save();
          if($annun->post->annunciation>10)
          $post->delete();
        }
          }
}
