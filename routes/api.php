<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'threads', 'namespace' => 'Api' ], function() {
  Route::get('/', 'ThreadController@index');
});
