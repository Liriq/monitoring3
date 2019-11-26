<?php

/*
|--------------------------------------------------------------------------
| Frontend Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/reports', 'ReportController@index')->name('reports.index');
Route::get('/json-reports', 'ReportController@jsonReports')->name('reports.json-reports');

Route::get('/lang/{locale?}', [
    'as'=>'lang',
    'uses'=>'FrontendController@changeLang'
]);

