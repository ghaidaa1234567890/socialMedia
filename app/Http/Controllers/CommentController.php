<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Controllers\FileController as FileController;
class CommentController extends FileController
{
    //
    public function indexc($id)
{
  $comments=Comment::where('id_post',$id)->get();

 return response()->json($comments, 200);


}

   
    public function show($id)
    {
    $comment = Comment::find($id);

    if (isset($comment)) {
       $response['data'] = $comment;
       $response['message'] = "Success";
       return  response()->json($response,200);

    }
       $response['data'] = $comment;
       $response['message'] = " Not Found";
       return  response()->json($response,404);
      
    }


    public function  addComment(Request $request,$id){
       
      $user_id = Auth::id();

        if(Post::find($id)==null)    
         {
             return response()->json(['message'=>'post not found']);
         }
        $input=$request->validate([
           
            'text'=>'required|string'  ,
           
          ]);
      $photo=$this->saveFile($request,'image',public_path('public/uploads/'));

       $data= new Comment();
       $data->text=$request->text;
       $data->image=$photo;
       $data->id_post=$id;
       $data->id_user_comment=$user_id;
       $data->save();

            return  response()->json(['message'=>'comment save successfully'], 200);
        
        }



    public function update(Request $request , $id)
    {
     
    if (Comment::find($id)==null)
     {
      return response()->json(['message'=>'comment not found']);
       
    }
    $photo=$this->saveFile($request,'image',public_path('public/uploads/'));

   $data=Comment::find($id);
 $data->text=$request->text;
 $data->image=$photo;
$data->update();

    return response()->json(['message'=>'comment update successfully'], 200);
   }

    
    public function destroy($id)
    {
     $comment = Comment::find($id);
 
     if (isset($comment)) {
        $comment->delete();
        
       return  response()->json(['message'=>'comment Deleted Successfully'],200);

    }
       
       return  response()->json(['message'=>'Not Found'],401);
   
    
}


}
