<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//User Login
Route::get('user_login', 'UserLoginController@index');
Route::post('user_login', 'UserLoginController@create');
Route::post('/user_login/{id}', 'UserLoginController@update');
Route::delete('/user_login/{id}', 'UserLoginController@delete');
Route::post('login', 'UserLoginController@login');

//Post
Route::get('post', 'PostController@index');
Route::post('post', 'PostController@create');
Route::post('/post/{id}', 'PostController@update');
Route::delete('/post/{id}', 'PostController@delete');

//Like
Route::post('like', 'LikeController@create');
Route::delete('/like/{id}', 'LikeController@delete');

//Comment
Route::get('/comment/{id}', 'CommentController@index');
Route::post('comment', 'CommentController@create');
Route::post('/comment/{id}', 'CommentController@update');
Route::delete('/comment/{id}', 'CommentController@delete');