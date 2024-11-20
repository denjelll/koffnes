<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

//cashier

Route::get('/cashier/home', function () {
    return view('/cashier/menu');
});

Route::get('/cashier/add_ons', function(){
    return view('/cashier/add_ons');
});

Route::get('/cashier/chart', function(){
    return view('/cashier/chart');
});

Route::get('/cashier/checkout', function(){
    return view('/cashier/checkout');
});

Route::get('cashier/history', function(){
    return view('/cashier/history');
});

Route::get('/cashier/order', function(){
    return view('/cashier/order');
});

Route::get('/cashier/inventory', function(){
    return view('/cashier/inventory');
});

Route::get('/cashier/Table', function(){
    return view('/cashier/table');
});

//bagian lain

Route::controller( LoginController::class)->group(function(){
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login/verify', 'verify')->name('login.verify');
});

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin', 'index')->name('admin.index');
    Route::get('/admin/logout', 'logout')->name('admin.logout');
});

Route::controller(OrderController::class)->group(function() { 
    Route::get('/order/table/{tableNumber}', 'showTableForm');
    Route::post('/order/table/{tableNumber}', 'storeCustomer');
    Route::get('/order/{tableNumber}/menu', 'showMenu');
    Route::post('/order/{tableNumber}/menu', 'checkout');
});
