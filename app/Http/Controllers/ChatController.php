<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Http\Controllers\FileController as FileController;

class ChatController extends FileController
{
  public function store(Request $request,$id)
  {
    $user_id=Auth::id(); 
      $request->validate([
          'message'=>'required',
          ]);
  $photo=$this->saveFile($request,'image',public_path('public/uploads/'));
  $chat=new Chat();
  $chat->message=$request->message;
  $chat->user_second_id=$id;
  $chat->user_id=$request->user_id;
  $chat->image=$photo;
  $chat->save();
  
  return response()->json($chat, 200);
}

   }
 