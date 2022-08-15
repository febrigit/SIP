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
    return view('login');
});

Route::post('login', 'IndexController@login');
Route::get('logout', 'IndexController@logout');

Route::prefix('dashboard')->middleware('admin')->group(function(){
    Route::get('/', 'IndexController@dashboard')->name('dashboard');

});
