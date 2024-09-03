<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Replies;

use App\Models\CommentReplies;
use App\Models\Comment;
use App\Http\Requests\StoreComment_RepliesRequest;
use App\Http\Requests\UpdateComment_RepliesRequest;

class CommentRepliesController extends Controller
{
  
    public function store($id)
    {
        $id_replies=Replies::query()->select('id');         
        
        $commentReplies=CommentReplies::create([
            'id_replie'=>$id_replies,
            'id_comment'=>$id,
            ]);
      
        return response()->json(['message'=>'successfully'], 200);

    }

      
}
