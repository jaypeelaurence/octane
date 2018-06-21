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

Route::get('/manage-account', 'AccountController@account');

Route::get('/manage-account/add', 'AccountController@add');

Route::get('/manage-account/{uid}', 'AccountController@view');

Route::get('/manage-account/{uid}/edit', 'AccountController@edit');

Route::get('/manage-account/{uid}/delete', 'AccountController@delete');

Route::get('/account/{uid}', 'AccountController@index');

Route::get('/account/logout', 'AccountController@logout');

Route::get('/account/change-password/{uid}', 'AccountController@changePass');

Route::get('/report', 'ReportController@index');

Route::get('/report/generate', 'ReportController@generate');

Route::get('/report/download', 'ReportController@download');