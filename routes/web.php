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

/** Worker routes */
Route::resource('user', 'UserController')->middleware('role:admin');

/** sheet routes */
Route::resource('sheet', 'SheetController')->middleware('role:admin');

Route::post('/worker-to-sheet/add', 'SheetWorkerController@store')->name('add.worker')->middleware('role:admin');
