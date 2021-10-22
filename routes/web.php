<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function (){
    Route::middleware('isManager')->prefix('manager')->group(function (){
        Route::get('feedbacks', 'App\Http\Controllers\Manager\ManagerController@show')->name('feedbacks');
    });

});

Route::middleware(['isUser','throttle:postFeedback','auth'])->group(function (){
    Route::get('feedback/add','App\Http\Controllers\User\UserController@add');
   // Route::middleware(['throttle:postFeedback'])->group(function (){
        Route::post('feedback/add','App\Http\Controllers\User\UserController@store')->name('feedback.post');
//    });
});
Route::get('/','App\Http\Controllers\RedirectController')->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
