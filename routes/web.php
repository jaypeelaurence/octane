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

Route::get('/', 'MainController@index')->name('home')->middleware('auth');

Route::get('/manage-account', 'AccountController@index')->middleware(['auth','admin']);

Route::get('/manage-account/add', 'AccountController@create')->middleware(['auth','admin']);
Route::post('/manage-account/add', 'AccountController@store')->middleware(['auth','admin']);

Route::get('/manage-account/{uid}', 'AccountController@show')->middleware(['auth','admin']);

Route::get('/manage-account/{uid}/edit', 'AccountController@edit')->middleware(['auth','admin']);
Route::post('/manage-account/{uid}/edit', 'AccountController@update')->middleware(['auth','admin']);

Route::post('/manage-account/{uid}', 'AccountController@destroy')->middleware(['auth','admin']);

Route::get('/account/login', 'SessionsController@create');
Route::post('/account/login', 'SessionsController@store');

Route::get('/account/forgot-password', 'SessionsController@forgotCreate');
Route::post('/account/forgot-password', 'SessionsController@forgotStore');

Route::get('/account/logout', 'SessionsController@destroy')->middleware('auth');

Route::get('/account/{uid}', 'MainController@show')->middleware(['auth','account']);

Route::get('/account/{uid}/change-password', 'AccountController@change')->middleware(['auth','account']);	
Route::post('/account/{uid}/change-password', 'AccountController@changeUpdate')->middleware('auth');

Route::get('/report', 'ReportController@index')->middleware('auth');
Route::post('/report', 'ReportController@show')->middleware('auth');
Route::post('/report/download', 'ReportController@get')->middleware('auth');
Route::get('/report/{accountId}', 'ReportController@load')->middleware('auth');

Route::get('/token/{hash}', 'SessionsController@token');
Route::post('/token/{hash}', 'SessionsController@tokenUpdate');

Route::get('/error/{code}', 'MainController@error')->middleware('auth');