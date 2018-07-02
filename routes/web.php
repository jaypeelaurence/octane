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

Route::get('/', 'MainController@index');

Route::get('/manage-account', 'AccountController@index');

Route::get('/manage-account/add', 'AccountController@create');
Route::post('/manage-account/add', 'AccountController@store');

Route::get('/manage-account/{uid}', 'AccountController@show');

Route::get('/manage-account/{uid}/edit', 'AccountController@edit');
Route::post('/manage-account/{uid}/edit', 'AccountController@update');

Route::get('/manage-account/{uid}/delete', 'AccountController@destroy');


Route::get('/account/login', 'MainController@login');
Route::post('/account/login', 'MainController@loginValidate');

Route::get('/account/{uid}', 'MainController@show');

Route::get('/account/{uid}/change-password', 'AccountController@change');
Route::post('/account/{uid}/change-password', 'AccountController@changeValidate');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
