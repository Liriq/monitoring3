<?php

Route::get('/', 'AdminController@index')->name('index');
Route::resource('users', 'UserController');
