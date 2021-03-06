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

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVarify;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return Carbon::parse(1)->month;
// });

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/register-member', 'WorkerController@store')->name('member.register');

/** Worker routes */
Route::resource('user', 'UserController')->middleware('role:admin');
Route::get('/varify-email/{encryptId}/{email}', 'UserController@varifyEmail');
Route::get('user-new', 'UserController@new')->name('user.new')->middleware('role:admin');
Route::get('user-sheet-runnig/{user_id}', 'UserController@sheetRunnig')->name('user.sheetrunnig')->middleware('role:admin');
Route::post('/user/status-change', 'UserController@statusChange')->name('status.change')->middleware('role:admin');

/** sheet routes */
Route::resource('sheet', 'SheetController')->middleware('role:admin');
Route::resource('lead-track', 'LeadTrackerController')->middleware('auth');
Route::resource('bill', 'BillController')->except('show', 'edit', 'update')->middleware('role:admin');
Route::get('bill/{month}', 'BillController@filter')->middleware('role:admin');

Route::resource('worker', 'WorkerController')->middleware('auth');
Route::get('/sheet-complete', 'SheetController@completed')->name('sheet.complete');
Route::get('/sheet/done/{id}', 'SheetController@markDone')->name('sheet.done');
Route::get('/sheet/done-undo/{id}', 'SheetController@markUnDone')->name('sheet.undodone');

Route::post('/worker-to-sheet/add', 'SheetWorkerController@store')->name('add.worker')->middleware('role:admin');
Route::get('/worker-to-sheet/{sheet_id}', 'SheetWorkerController@getWorkers')->name('get.worker')->middleware('role:admin');
Route::get('/worker-to-sheet-remove/{id}', 'SheetWorkerController@removeWorkers')->name('worker.remove')->middleware('role:admin');

Route::get('/leads-report', 'SheetWorkerController@report')->name('lead.report')->middleware('auth');
Route::get('/leads-report/user/{user_id}/{month}', 'SheetWorkerController@reportDetailsUser')->name('lead.report.user')->middleware('auth');

Route::get('/leads-report/{month}', 'SheetWorkerController@reportByMonth')->middleware('auth');

Route::get('/lead-details/{sheetWorkerId}', 'SheetWorkerController@reporentry')->name('lead.detailsentry')->middleware('auth');

Route::get('/lead-details/update/{leadTrackId}/{lead_count}', 'SheetWorkerController@entryUpdate')->name('lead.entryupdate')->middleware('auth');
Route::get('/lead-details/delete/{leadTrackId}', 'SheetWorkerController@entryDelete')->name('lead.entrydelete')->middleware('role:admin');


Route::get('/migrate', function () {
    Artisan::call('migrate');
});

Route::get('/test', function () {
    $user = \App\User::find();
    Mail::to($user->email)->send(new EmailVarify($user));
});
