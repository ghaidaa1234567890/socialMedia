<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\FileController as FileController;
class PostController extends FileController
{ 
   
  
  public function indexp()
{
  $user=Auth::id();
 // return $user;
  $post=Post::where('user_id',$user)->get();
 return response()->json($post, 200);
}
    public function searchpost(Request $request){
        $input= new Category();
        $input->category=$request->category;
        $id_category=Category::query()->where('name',$input->category)->select('id')->get()[0]['id'];
           
    
        $post = Post::select('id','description','id_category','user_id','image')
          ->where('id_category','=',$id_category)
          ->get();
        return response()->json($post,200);
      }


    public function indexpost()
    {
        $post=Post::all();
        $post=Post::select( 'description','id_category','user_id','image')->get();
        return response()->json( $post,200);

    }


    public function orderBy(){
      $post = Post::query()
        ->orderBy('id', 'asc')
        ->get();
      return response()->json($post,200);
    }
    


    public function storepost(Request $request)
    {
        $user_id = Auth::id();
        $data=$request->validate([
           
          'description'=>'required|string'  ,
          'id_category'=>'required',
         

        ]);

    $photo=$this->saveFile($request,'image',public_path('public/uploads/'));

        $categories = Category::all();
    foreach ($categories as $category)
      if ($category['name']==$request->input('category'))
        $categoryId = $category['id'];

      
        $post=Post::create([
            'description'=>$data['description'],
            'id_category'=>$data['id_category'],
            'user_id'=> $user_id,
            'image'=>$photo,
            ]);
    
            return  response()->json(['message'=>'post save successfully'], 200);
    }
    
 
    public function showpost($id)
    {
    $post = Post::find($id);
    if (isset($post)) {

       $response['data'] = $post;
       $response['message'] = "Success";
       return  response()->json($response,200);

    }
       $response['data'] = $post;
       $response['message'] = " Not Found";
       return  response()->json($response,404);
       

    }
    
    
    public function update(Request $request, $id)
    {

       $input=Post::find($id);
     
         if (isset($input)) {
          $photo=$this->saveFile($request,'image',public_path('public/uploads/'));

           $input->description=$request->description;
           $input->id_category=$request->id_category;
           $input->image=$photo;
    
           $input->update();
           return response()->json(['message'=>'post update successfully'], 200);
          }

         return response()->json(['message'=>'not found post'], 401);
    }

    

    public function destroy($id)
    {
        $post = Post::find($id);
  if (isset( $post)) {
       $post->delete();
       return  response()->json(['message' => 'post Deleted Successfully'],200);
    } 
       return  response()->json(  ['message' => 'Not Found'],404);
    
   
    
} 

}