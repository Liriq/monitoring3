<?php

Route::get('/', 'DashboardController@index')->name('index');
Route::resource('reports', 'ReportController');