<?php

Route::get('/', 'AdminController@index')->name('index');
Route::resource('users', 'UserController');
Route::resource('templates', 'TemplateController');
Route::resource('settings', 'SettingController');
Route::resource('reports', 'ReportController');
Route::as('reports.')->prefix('reports')->group(function () {
    Route::post('/get-answers', 'ReportController@getAnswers')->name('get-answers');   
}); 