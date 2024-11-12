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

//Route Sementara
Route::get('/input', function () {
    return view('/customer/input');
});

Route::get('/home', function () {
    return view('/customer/home');
});