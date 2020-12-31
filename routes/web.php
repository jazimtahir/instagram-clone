<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::post('follow/{user}', 'FollowController@store');
Route::post('like/{post}', 'LikeController@store');

Route::get('/{user}/password/edit', 'UserController@editPassword');
Route::patch('/{user}/password', 'UserController@updatePassword');

Route::get('/{user}', 'ProfileController@index')->name('profile.show');
Route::patch('/{user}', 'ProfileController@update')->name('profile.update');
Route::get('/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::delete('/{user}/pic/delete', 'ProfileController@profilePicDelete');

Route::get('/', 'PostController@index');
Route::post('/p', 'PostController@store');
Route::get('/p/create', 'PostController@create');
Route::get('/p/{post}/edit', 'PostController@edit');
Route::patch('/p/{post}', 'PostController@update');
Route::get('/p/{post}', 'PostController@show');
Route::delete('/p/{post}', 'PostController@destroy');

