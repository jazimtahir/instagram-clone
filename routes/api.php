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

Route::get('post/{post}/comments', 'CommentController@index');
Route::post('post/{post}/comment', 'CommentController@store');

Route::get('search', 'SearchController@search');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
