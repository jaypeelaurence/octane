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

Route::get('/manage-account', 'AccountController@index')->middleware('auth');

Route::get('/manage-account/add', 'AccountController@create')->middleware('auth');
Route::post('/manage-account/add', 'AccountController@store')->middleware('auth');

Route::get('/manage-account/{uid}', 'AccountController@show')->middleware('auth');

Route::get('/manage-account/{uid}/edit', 'AccountController@edit')->middleware('auth');
Route::post('/manage-account/{uid}/edit', 'AccountController@update')->middleware('auth');

Route::get('/manage-account/{uid}/delete', 'AccountController@destroy')->middleware('auth');

Route::get('/account/login', 'SessionsController@create');
Route::post('/account/login', 'SessionsController@store');

Route::get('/account/logout', 'SessionsController@destroy')->middleware('auth');

Route::get('/account/{uid}', 'MainController@show')->middleware('auth');

Route::get('/account/{uid}/change-password', 'AccountController@change')->middleware('auth');
Route::post('/account/{uid}/change-password', 'AccountController@changeUpdate')->middleware('auth');