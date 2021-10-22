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

//Manager routes
Route::middleware('auth')->group(function (){
    Route::middleware('isManager')->prefix('manager')->group(function (){
        Route::get('feedbacks', 'App\Http\Controllers\Manager\ManagerController@show')->name('feedbacks');
    });

});

//User routes
Route::middleware(['isUser','auth'])->group(function (){
    Route::get('feedback/add','App\Http\Controllers\User\UserController@add');
    Route::get('feedback/success','App\Http\Controllers\User\UserController@addedSuccessful')->name('addedSuccessful');
    Route::middleware(['throttle:userThrottle:1,1440'])->group(function (){
        Route::post('feedback/add','App\Http\Controllers\User\UserController@store')->name('feedback.post');
    });
});
Route::get('/','App\Http\Controllers\RedirectController')->middleware(['auth'])->name('index');

require __DIR__.'/auth.php';
