<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads', 'ThreadController@index');
Route::post('/threads', 'ThreadController@store');
Route::get('/threads/create', 'ThreadController@create');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::delete('threads/{channel}/{thread}', 'ThreadController@destroy');

Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::patch('/replies/{reply}', 'ReplyController@update');
Route::delete('/replies/{reply}', 'ReplyController@destroy');

Route::get('/threads/{channel}',  'ThreadController@index');

Route::post('/replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/profiles/{user}', 'ProfileController@show')->name('profile');


// Admin Panel Control
Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function() {
  Route::get('/users', 'AdminController@index');
});
