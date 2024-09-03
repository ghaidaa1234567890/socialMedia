<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\User;
use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\UpdateFollowRequest;

class FollowController extends Controller
{
   public function showmyfollow()
   {
    $user=Auth::id();
     $follow=Follow::where('id_user',$user)->get();
    return response()->json($follow, 200);
   
   }

    public function indexuser()
    {
    //أشخاص قد تعرفهم
    
    $user= User::all();
     
     $response['data'] =   $user;
     $response['message'] = "This is all friends";
     return  response()->json($response,200);
    }
   
public function searchname( Request $request)
{

$name=$request->name;

$searchname=User::where('name','like','%'.$name.'%')
->select('id','name','image','description')->get();

 return response()->json($searchname, 200);


 
//return User::where('name','like','%'.$name.'%')->get();
}

public function addfollow($id)
{
    
 $user_id =Auth::id();
 $addfollow=new Follow();
 $addfollow->id_user=$user_id;
 $addfollow->follow_user_id=$id;
 $addfollow->save();
 
return  response()->json(['message'=>'Friend Added Successfully'],200);
 
}

public function getProfileUser($user_id){
    $user = User::query()->select('id','name','image','description')
      ->where('id','=',$user_id)->get();
    return response()->json($user);
    }
  
    public function getmyProfileUser(){
      $user_id=Auth::id();
      $user = User::query()->select('id','name','image','description')
        ->where('id','=',$user_id)->get();
      return response()->json($user);
      }
   
   
public function deletefollow($id)
{
    $dele=Follow::find($id)->delete();
    $response['message'] = "Follow delete Successfully";
    return  response()->json($response,200);
 
}
    }
