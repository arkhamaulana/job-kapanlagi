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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->middleware('Admin');
Route::post('/admin/store', 'AdminController@store')->middleware('Admin');
Route::post('/admin/update', 'AdminController@update')->middleware('Admin');
Route::get('/admin/delete_user/{id}', 'AdminController@delete_user')->middleware('Admin');

Route::get('/data_user', 'DataController@index');
Route::post('/data_user/store', 'DataController@store');
Route::post('/data_user/update', 'DataController@update');
Route::get('/data_user/detail/{id}', 'DataController@detail');
Route::get('/data_user/delete/{id}', 'DataController@delete');
