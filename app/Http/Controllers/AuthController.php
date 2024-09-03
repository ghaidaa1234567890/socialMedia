<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\FileController as FileController;

class AuthController extends FileController

     
{

    public function loginAdmin(Request $request)
    {

        $admin = new User;
        $admin->firstname = 'John';
        $admin->lastname = 'Doe';
        $admin->email = 'johndoe@example.com';
        $admin->password = bcrypt('password');
        $admin->role = 1; // Set the admin role
        $admin->save();
        User::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'),
        ]);


    }


    public function register(Request $request)
    {
        
     $data=$request->validate([
     'name'=>'required|string|max:191',
     'email'=>'required|email|max:191|unique:users,email',
     'password'=>'required|string',
     'c_password'=>'required|string|same:password',
     'image'=>'required|min:1',
     'description'=>'required|string',
     //'id_city'=>'required',

     ]);

   
         
    $photo=$this->saveFile($request,'image',public_path('public/uploads/'));
     $user=User::create([
         'name'=>$data['name'],
         'email'=>$data['email'],
         'password'=>Hash::make($data['password']),
         'c_password'=>Hash::make($data['c_password']),
        'image'=>$photo,
         'description'=>$data['description'],
         //'id_city'=>$data['id_city'],
         
     ]);

       
     $token = $user->createToken('ghaidaaProjectToken')->plainTextToken;

     $response=[
     'user'=>$user,
     'token'=>$token,

     ];
     
 return response( $response,201);


    }

  
   /* public function logout()
    {
        auth()->user()->tokens()->delete();
       
        return response(['message'=>'logged out successfully']);
    }*/

    
    public function login(Request $request)
    {
    
  
        $data=$request->validate([
           
            'email'=>'required|email|max:191',
            'password'=>'required|string',
       
            ]);
            $user=User::where('email',$data['email'])->first();
            
           if(!$user||!Hash::check($data['password'],$user->password)){

            return response(['message'=>'Invalid Credentials'],401);
           }
           else{

            $token = $user->createToken('ghaidaaProjectToken')->plainTextToken;
            $response=[
                'user'=>$user,
                'token'=>$token,
           
                ];
                return response($response,200);

           }


    }








}
