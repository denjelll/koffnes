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
    Route::get('/admin/menu', 'menu')->name('admin.menu');
    Route::get('/admin/menu/add', 'showAddMenuForm')->name('admin.menu.add');
    Route::post('/admin/store', 'storeMenu')->name('admin.store');
    Route::get('/admin/menu/edit/{menu:nama_menu}', 'showEditMenuForm')->name('admin.menu.edit');
    Route::get('/admin/menu/delete/{id}', 'DeleteMenu')->name('admin.menu.delete');
    Route::post('/admin/update', 'updateMenu')->name('admin.update.menu');
    Route::get('/admin/kategori', 'category')->name('admin.kategori');
});


Route::controller(OrderController::class)->group(function() { 
    Route::get('/order/table/{tableNumber}', 'showTableForm');
    Route::post('/order/table/{tableNumber}', 'storeCustomer');
    Route::get('/order/{tableNumber}/menu', 'showMenu');
    Route::post('/order/{tableNumber}/menu', 'checkout');
});
