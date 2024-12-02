<?php

use App\Models\Menu;
use App\Models\Event;
use App\Models\Kategori;
use App\Livewire\Checkout;
use App\Livewire\Dashboard;
use App\Livewire\Inventory;
use App\Livewire\OrderMenu;
use App\Models\Isi_kategori;
use App\Livewire\CartPesanan;
use App\Livewire\PesanManual;
use App\Livewire\HistorySearch;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\DailyReportController;

Route::get('/', function () {
    $events = Event::all();
    $menus = Menu::all()->take(4);  
    $kategori_bundle = Kategori::where('nama_kategori', 'Bundling')->first();
    $bundles = Isi_kategori::where('id_kategori', $kategori_bundle->id_kategori)->get()->take(3);
    return view('home', compact( 'menus', 'events', 'bundles'));
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/events', function () {
    $events = Event::all();
    return view('events', compact('events'));
});

Route::get('/menugate', function () {
    return view('menu_gate');
});

Route::get('/closed', function () {
    return view('closed');
})->name('closed.page');


Route::controller( LoginController::class)->group(function(){
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login/verify', 'verify')
    ->middleware('throttle:5,1')
    ->name('login.verify');
});

Route::middleware(['role:Admin'])->group(function() {
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin', 'menu')->name('admin');
        Route::get('/admin/logout', 'logout')->name('admin.logout');
        Route::get('/admin/menu', 'menu')->name('admin.menu');
        Route::get('/admin/menu/add', 'showAddMenuForm')->name('admin.menu.add');
        Route::post('/admin/store', 'storeMenu')->name('admin.store');
        Route::get('/admin/menu/edit/{menu:nama_menu}', 'showEditMenuForm')->name('admin.menu.edit');
        Route::get('/admin/menu/delete/{id}', 'DeleteMenu')->name('admin.menu.delete');
        Route::post('/admin/update', 'updateMenu')->name('admin.update.menu');
        Route::get('/admin/promo', 'promo')->name('admin.promo');
        Route::get('/admin/promo/add', 'showAddPromoForm')->name('admin.promo.add');
        Route::post('/admin/promo/store', 'storePromo')->name('admin.promo.store');
        Route::get('/admin/promo/edit/{promo:judul_promo}', 'showEditPromoForm')->name('admin.promo.edit');
        Route::post('/admin/promo/update', 'updatePromo')->name('admin.promo.update');
        Route::get('/admin/promo/delete/{promo:judul_promo}', 'deletePromo')->name('admin.promo.delete');
        Route::get('/admin/promo/menu/{promo:judul_promo}', 'showAddMenuPromoForm')->name('admin.promo.menu');
        Route::get('/admin/kategori', 'kategori')->name('admin.kategori');
        Route::get('/admin/kategori/add', 'showAddKategoriForm')->name('admin.kategori.add');
        Route::post('/admin/kategori/store', 'storeKategori')->name('admin.kategori.store');
        Route::get('/admin/kategori/edit/{kategori:nama_kategori}', 'showEditKategoriForm')->name('admin.kategori.edit');
        Route::post('/admin/kategori/update', 'updateKategori')->name('admin.kategori.update');
        Route::get('/admin/kategori/delete/{kategori:nama_kategori}', 'deleteKategori')->name('admin.kategori.delete');
        Route::get('/admin/user', 'user')->name('admin.user');
        Route::get('/admin/add_user', 'showAddUserForm')->name('admin.add_user');
        Route::post('/admin/store_user', 'storeUser')->name('admin.store_user');
        Route::get('/admin/edit_user/{user:nama_depan}', 'showEditUserForm')->name('admin.edit_user');
        Route::post('/admin/update_user', 'updateUser')->name('admin.update_user');
        Route::get('/admin/delete_user/{user:nama_depan}', 'deleteUser')->name('admin.delete_user');
        Route::get('admin/event', 'event')->name('admin.event');
        Route::get('admin/event/add', 'showAddEventForm')->name('admin.add_event');
        Route::post('admin/event/store', 'storeEvent')->name('admin.store_event');
        Route::get('admin/event/edit/{event:nama_event}', 'showEditEventForm')->name('admin.edit_event');
        Route::get('admin/event/delete/{event:nama_event}', 'deleteEvent')->name('admin.delete_event');
        Route::post('admin/event/update', 'updateEvent')->name('admin.update_event');
        Route::post('/admin/promo/update-status/{id}', [AdminController::class, 'updatePromoStatus'])->name('admin.promo.update-status');
        Route::get('/admin/transaction', 'transaction')->name('admin.transaction');
        Route::get('/admin/transaction/date/{date}', 'transactionDate')->name('admin.transaction.date');
        Route::get('/admin/transaction/detail/{order:id_order}', 'transactionDetail')->name('admin.detail_transaction');
        Route::get('/admin/transaction/export/{date}', 'downloadExcelTransaction')->name('admin.transaction.export');
        Route::get('/admin/transaction/export/byID/{id_order}', 'downloadExcelTransactionByID')->name('admin.transaction.export.id_order');
        Route::get('admin/status', 'status')->name('admin.koffnesstatus');
        Route::post('admin/status', 'toggleStatus')->name('admin.toggleStatus');
    
    });
});




Route::middleware(['role:Kasir|Admin'])->group(function () {
    Route::get('cashier', PesanManual::class)->name('pesan-manual');
    Route::get('cashier/cart', CartPesanan::class)->name('cart-pesanan');
    Route::get('cashier/dashboard', Dashboard::class)->name('dashboard');
    Route::get('cashier/transaksi', HistorySearch::class)->name('history-search');
    Route::post('/receipt/{id}', [CashierController::class, 'printReceipt'])->name('pos.receipt');
    Route::post('/daily-report', [DailyReportController::class, 'generateDailyReport'])->name('daily.report');
    Route::get('cashier/stock', Inventory::class)->name('inventory');
});

Route::middleware(['check_koffnes'])->group(function () {
    Route::controller(OrderController::class)->group(function() {
        Route::get('/order/meja/{nomorMeja}', 'formMeja')->name('order.formMeja');
        Route::post('/order/meja/{nomorMeja}', 'saveCustomer')->name('order.saveCustomer');

        Route::get('/order/{id_order}', 'orderSuccess')->name('order.successful');
    });
});

Route::get('/order/meja/{nomorMeja}/menu', OrderMenu::class)->name('order.menu');
Route::get('/order/meja/{nomorMeja}/checkout', Checkout::class)->name('checkout');

