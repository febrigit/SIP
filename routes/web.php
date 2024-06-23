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
    Route::get('/change-password', 'IndexController@changePassword')->name('change-password');
    Route::post('/change-password/save', 'IndexController@saveChangePassword')->name('save.change-password');

    Route::get('/dashboard', 'IndexController@dashboard')->name('dashboard');
    Route::post('/notification/read', 'IndexController@readNotification')->name('notification.read');
    Route::post('/notification/read-all', 'IndexController@readAllNotification')->name('notification.read-all');

    Route::resource('/permission', 'PermissionController');

    Route::resource('/user', 'UserController');
    
    Route::resource('/position', 'PositionController');
    Route::resource('/unit', 'UnitController');
    Route::resource('/item', 'ItemController');

    Route::resource('/item-receive', 'ItemReceiveController');
    Route::put('/item-receive/{id}/submit', 'ItemReceiveController@submit')->name('item-receive.submit');
    Route::resource('/item-receive-detail', 'ItemReceiveDetailController');

    Route::resource('/item-usage', 'ItemUsageController');
    Route::put('/item-usage/{id}/submit', 'ItemusageController@submit')->name('item-usage.submit');
    Route::resource('/item-usage-detail', 'ItemusageDetailController');

    Route::resource('/stock-adjustment', 'StockAdjustmentController');
    Route::get('/stock-adjustment/{stock_adjustment}/create', 'StockAdjustmentController@create')->name('stock-adjustment.create');

    Route::resource('/stock-opname', 'StockOpnameController');
    Route::put('/stock-opname/{id}/submit', 'StockOpnameController@submit')->name('stock-opname.submit');
    Route::resource('/stock-opname-detail', 'StockOpnameDetailController');

    Route::resource('/item-log', 'ItemLogController');

    Route::resource('/banner', 'BannerController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/social', 'SocialController');

    Route::resource('/content', 'ContentController');

    // print route
    Route::prefix('print')->name('print.')->group(function(){
        Route::get('/activity-budget-request/{id}', 'ActivityBudgetRequestController@print')->name('activity-budget-request');
        Route::get('/activity-budget-request/slip/{id}', 'ActivityBudgetRequestController@printSlip')->name('activity-budget-request.slip');
        Route::get('/purchase-request/{id}', 'PurchaseRequestController@print')->name('purchase-request');
        Route::get('/purchase-order/{id}', 'PurchaseOrderController@print')->name('purchase-order');
        Route::get('/travel-advance-request/{id}', 'TravelAdvanceRequestController@print')->name('travel-advance-request');
        Route::get('/additional/{id}', 'AdditionalController@print')->name('additional');
        Route::get('/lar/{id}', 'LarController@print')->name('lar');
        Route::get('/ter/{id}', 'TerController@print')->name('ter');
        Route::get('/voucher/{id}', 'VoucherController@print')->name('voucher');
    });
});

Route::get('rab/program/{program_id}', 'RabController@getRabProgram');