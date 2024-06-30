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

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});

Route::post('login', 'IndexController@login');
Route::get('logout', 'IndexController@logout');

Route::prefix('')->middleware('admin')->group(function(){
    Route::get('/dashboard', 'IndexController@dashboard')->name('dashboard');

    Route::get('/change-password', 'IndexController@changePassword')->name('change-password');
    Route::post('/change-password/save', 'IndexController@saveChangePassword')->name('save.change-password');

    Route::resource('/role', 'RoleController');
    Route::resource('/permission', 'PermissionController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/article', 'ArticleController');

    Route::resource('/user', 'UserController');

    Route::get('/role-permission/create/{role_id}', 'RolePermissionController@create')->name('role-permission.create');
    Route::post('/role-permission/store', 'RolePermissionController@store')->name('role-permission.store');
    Route::delete('/role-permission/{id}', 'RolePermissionController@destroy')->name('role-permission.destroy');
});