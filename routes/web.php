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

// use Carbon\Carbon;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return Carbon::parse(1)->month;
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/register-member', 'WorkerController@store')->name('member.register');

/** Worker routes */
Route::resource('user', 'UserController')->middleware('role:admin');
Route::post('/user/status-change', 'UserController@statusChange')->name('status.change')->middleware('role:admin');

/** sheet routes */
Route::resource('sheet', 'SheetController')->middleware('role:admin');
Route::resource('lead-track', 'LeadTrackerController')->middleware('auth');
Route::resource('worker', 'WorkerController')->middleware('auth');

Route::post('/worker-to-sheet/add', 'SheetWorkerController@store')->name('add.worker')->middleware('role:admin');
Route::get('/worker-to-sheet/{sheet_id}', 'SheetWorkerController@getWorkers')->name('get.worker')->middleware('role:admin');
Route::get('/worker-to-sheet-remove/{id}', 'SheetWorkerController@removeWorkers')->name('worker.remove')->middleware('role:admin');

Route::get('/leads-report', 'SheetWorkerController@report')->name('lead.report')->middleware('role:admin');
Route::get('/leads-report/user/{user_id}/{month}', 'SheetWorkerController@reportDetailsUser')->name('lead.report.user')->middleware('role:admin');

Route::get('/leads-report/{month}', 'SheetWorkerController@reportByMonth')->middleware('role:admin');
