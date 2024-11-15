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
    Route::get('/admin', 'index')->name('admin.index');
    Route::get('/admin/logout', 'logout')->name('admin.logout');

    Route::get('/order/meja/{nomorMeja}', 'formMeja')->name('order.formMeja');
    Route::post('/order/meja/{nomorMeja}', 'saveCustomer')->name('order.saveCustomer');

    Route::get('/order/meja/{nomorMeja}/menu', 'showMenu')->name('order.menu');

    Route::post('/order/meja/{nomorMeja}/checkout', 'cart')->name('order.cart');
    Route::get('/order/meja/{nomorMeja}/checkout', 'checkout')->name('order.checkout');
    Route::get('/order/table/{tableNumber}', 'showTableForm');
    Route::post('/order/table/{tableNumber}', 'storeCustomer');
    Route::get('/order/{tableNumber}/menu', 'showMenu');
    Route::post('/order/{tableNumber}/menu', 'checkout');
});

//Route Sementara untuk contoh
Route::get('/input', function () {
    return view('/customer_ex/input');
});

Route::get('/home', function () {
    return view('/customer_ex/home');
});