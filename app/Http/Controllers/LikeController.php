<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
class LikeController extends Controller
{
  public function addLike($id){
    $user_id = Auth::user()->id;
   // $user_id=1;
    $like = Like::query()->where('user_id','=',$user_id)
    ->where('post_id','=',$id);
    if($like->get()->isNotEmpty()) {
      $post = Post::query()->find($id);
      $post->likes_count--;
      $post->save();
      $like->delete();
    }
    else {
      $like = Like::query()->create([
        'user_id' => $user_id,
        'post_id' => $id
      ]);
      $like->post->likes_count++;
      $like->post->save();
    }
  }}
