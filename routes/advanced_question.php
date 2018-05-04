<?php

Route::group(['prefix' => 'advanced', 'namespace' => 'Advanced'], function() {
  Route::get('/questions', 'QuestionController@index');
});
