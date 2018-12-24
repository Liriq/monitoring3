<?php

Route::get('/', 'AdminController@index')->name('index');
Route::resource('users', 'UserController');
Route::resource('templates', 'TemplateController');
Route::resource('settings', 'SettingController');
Route::resource('reports', 'ReportController');
