<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AuthController;
use  App\Http\Controllers\PostController;
use  App\Http\Controllers\CommentController;
use  App\Http\Controllers\RepliesController;
use  App\Http\Controllers\LikeController;
use  App\Http\Controllers\CommentRepliesController;
use  App\Http\Controllers\FollowController;
use  App\Http\Controllers\ChatController;
use  App\Http\Controllers\AnnunciationController;
use  App\Http\Controllers\ConverstationController;
use  App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('getpost',[PostController::class,'indexpost']);
//
Route::get('indexuser',[FollowController::class,'indexuser']);

Route::get('orderBy',[PostController::class,'orderBy']);
Route::get('showpost/{id}',[PostController::class,'showpost']);
Route::post('searchpost',[PostController::class,'searchpost']);
Route::get('category',[CategoryController::class,'catigory']);

Route::get('indexcomment/{id}',[CommentController::class,'index']);
Route::get('showcomment/{id}',[CommentController::class,'show']);

Route::get('indexc/{id}',[CommentController::class,'indexc']);

Route::get('showcompost/{id}',[CommentController::class,'showcompost']);

Route::get('indexreplie/{id}',[RepliesController::class,'index']);
Route::get('showreplie/{id}',[RepliesController::class,'show']);
//Route::get('indexr/{id}',[RepliesController::class,'indexr']);


Route::get('indexlike',[LikeController::class,'indexlike']);


Route::post('getProfileUser/{id}',[FollowController::class,'getProfileUser']);

Route::post('searchname',[FollowController::class,'searchname']);

Route::middleware('auth:sanctum')->group( function () {
    
    Route::post('addfollow/{id}',[FollowController::class,'addfollow']);
    Route::post('deletefollow/{id}',[FollowController::class,'deletefollow']);
    
    Route::get('showmyfollow',[FollowController::class,'showmyfollow']);

    Route::post('addannun/{id}',[AnnunciationController::class,'addannun']);

 Route::post('destroy/{id}',[PostController::class,'destroy']);
Route::post('updatepost/{id}',[PostController::class,'update']);
Route::get('logout',[AuthController::class,'logout']);
Route::post('storepost',[PostController::class,'storepost']);

Route::post('addComment/{id}',[CommentController::class,'addComment']);
Route::post('updateComment/{id}',[CommentController::class,'update']);
Route::post('destroyComment/{id}',[CommentController::class,'destroy']);
Route::post('addreplie/{id}',[RepliesController::class,'addReplies']);


Route::post('updateReplie/{id}',[RepliesController::class,'update']);
Route::post('destroyReplie/{id}',[RepliesController::class,'destroy']);

Route::post('addLike/{id}',[LikeController::class,'addLike']);


Route::post('store/{id}',[CommentRepliesController::class,'store']);


Route::post('getmyProfileUser',[FollowController::class,'getmyProfileUser']);
Route::post('storee/{id}',[ChatController::class,'store']);


//Route::post('addfollow/{id}',[FollowController::class,'addfollow']);
//Route::post('deletefriend/{id}',[FollowController::class,'deletefriend']);
Route::post('indexp',[PostController::class,'indexp']);

});
