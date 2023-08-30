<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\HomeController@index');

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function(){
        //Routes for Cashier
    Route::get('/cashier', 'App\Http\Controllers\Cashier\CashierController@index');
    Route::get('/cashier/getMenuByCategory/{category_id}', 'App\Http\Controllers\Cashier\CashierController@getMenuByCategory');
    Route::get('/cashier/getTable', 'App\Http\Controllers\Cashier\CashierController@getTables');
    Route::get('/cashier/getSaleDetailsByTable/{table_id}', 'App\Http\Controllers\Cashier\CashierController@getSaleDetailsByTable');
    Route::post('/cashier/confirmOrderStatus', 'App\Http\Controllers\Cashier\CashierController@confirmOrderStatus');
    Route::post('/cashier/orderFood', 'App\Http\Controllers\Cashier\CashierController@orderFood');
    Route::post('/cashier/deleteSaleDetail', 'App\Http\Controllers\Cashier\CashierController@deleteSaleDetail');
    Route::post('/cashier/savePayment', 'App\Http\Controllers\Cashier\CashierController@savePayment');
    Route::get('/cashier/showReceipt/{saleID}', 'App\Http\Controllers\Cashier\CashierController@showReceipt');
    Route::post('/cashier/increase-quantity', 'App\Http\Controllers\Cashier\CashierController@increaseQuantity');
    Route::post('/cashier/decrease-quantity', 'App\Http\Controllers\Cashier\CashierController@decreaseQuantity');

    
    

});


Route::middleware(['auth', 'VerifyAdmin'])->group(function(){
    Route::get('/management', function(){
        return view('management.index');
    });
    //Management Page Routes
    Route::resource('management/category','App\Http\Controllers\Management\CategoryController');
    Route::resource('management/menu','App\Http\Controllers\Management\MenuController');
    Route::resource('management/table','App\Http\Controllers\Management\TableController');
    Route::resource('management/user','App\Http\Controllers\Management\UserController');
    
    
    //Routes for Report
    Route::get('/report','App\Http\Controllers\Report\ReportController@index');
    Route::get('/report/show', 'App\Http\Controllers\Report\ReportController@show');
    
    
    //Export to Excel
    Route::get('/report/show/export', 'App\Http\Controllers\Report\ReportController@export');
});
    
