<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Replies;
use App\Models\CommentReplies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRepliesRequest;
use App\Http\Requests\UpdateRepliesRequest;
use App\Http\Controllers\FileController as FileController;
class RepliesController extends FileController
{
   /* 
  public function indexr($id)
  {
    $replie=CommentReplies::where('id_comment',$id);
   
    return response()->json($replies, 200);
  
  
  }
*/

    public function show($id)
    {
    $replies = Replies::find($id);

    if (isset($replies)) {
        $response['data'] = $replies;
       $response['message'] = "Success";
       return  response()->json($response,200);

    }
       $response['data'] = $replies;
       $response['message'] = " Not Found";
       return  response()->json($response,404);
      
    }


    public function  addReplies(Request $request,$id){
            
        $user_id = Auth::id();
      
       
        if(Comment::find($id)==null)    
         {
             return response()->json(['message'=>'Comment not found']);
         }
        
       $input=$request->validate([
           
            'text'=>'required|string'  ,
           
          ]);
         
         $photo=$this->saveFile($request,'image',public_path('public/uploads/'));
     
       $data= new Replies();
       $data->id_user_Replie=$user_id;
       $data->text=$request->text;
       $data->image=$photo;
     
       $data->save();
            return  response()->json(['message'=>'replies save successfully'], 200);
        
        }



    public function update(Request $request , $id)
    {
     
    if (Replies::find($id)==null)
     {
      return response()->json(['message'=>'Replie not found']);
    
    }
    $photo=$this->saveFile($request,'image',public_path('public/uploads/'));

   $data=Replies::find($id);
  $data->text=$request->text;
  $data->image=$photo;
  $data->update();

    return response()->json(['message'=>'Replie update successfully'], 200);
   }

    
    public function destroy($id)
    {
     $replies = Replies::find($id);
 
     if (isset($replies)) {
        $replies->delete();
        
       return  response()->json(['message'=>'comment Deleted Successfully'],200);

    }
       
       return  response()->json(['message'=>'Not Found'],401);
   
    
}
}
