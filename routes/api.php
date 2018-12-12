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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
     });
});
//posts api
Route::post('post/create', 'PostsController@create');
Route::get('post/{id}', 'PostsController@getPost');
Route::put('post/update/{id}', 'PostsController@updatePost');
//Comments api
Route::post('comment/create/{postId}', 'CommentsController@createComment');
Route::get('comment/show/{postId}', 'CommentsController@getComment');
Route::put('comment/update/{commentId}', 'CommentsController@updateComment');
