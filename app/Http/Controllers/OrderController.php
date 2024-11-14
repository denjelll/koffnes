<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Order;
use App\Models\DetailOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function formMeja($nomorMeja) 
    {
        if (session()->has('nama_customer') && session('meja') == $nomorMeja) {
            return redirect()->route('order.menu', ['nomorMeja' => $nomorMeja]);
        }

        return view('formMeja', compact('nomorMeja'));
    }

    public function saveCustomer(Request $request, $nomorMeja)
    {
        $request->validate([
            'nama_customer' => 'required|string|max:50',
        ]);

        $nama_customer = htmlspecialchars($request->nama_customer);

        // Simpan nama customer dan nomor meja ke session
        session([
            'nama_customer' => $nama_customer,
            'meja' => $nomorMeja,
        ]);

        return redirect()->route('order.menu', ['nomorMeja' => $nomorMeja]);
    }
   
    // Menampilkan form untuk memilih menu berdasarkan nomor meja
    public function showMenu($nomorMeja)
    {
        if (!session()->has('nama_customer') || session('meja') != $nomorMeja) {
            return redirect()->route('order.formMeja', ['nomorMeja' => $nomorMeja])
                ->with('error', 'Silakan isi data terlebih dahulu.');
        }

        $customer = session('nama_customer');
        $cart = session('cart', []);
        $menus = Menu::all();

        return view('orderMenu', compact('customer', 'nomorMeja', 'menus', 'cart'));
    }

    // Proses checkout untuk meja tertentu
    public function cart(Request $request, $nomorMeja)
    {
        $cart = json_decode($request->input('cartData'), true); // Ambil data cart dari input hidden
        Log::info('Cart Data Received in Controller: ', $cart);
        session(['cart' => $cart]); // Simpan cart ke session
        return redirect()->route('order.checkout', ['nomorMeja' => $nomorMeja]);
    }

    public function checkout($nomorMeja)
    {
        $cart = session('cart', []);
        $customer = session('nama_customer');
        return view('checkout', compact('cart', 'customer', 'nomorMeja'));
    }


    


    // Proses submit order setelah checkout
    // public function submitOrder(Request $request, $nomorMeja)
    // {
    //     // Generate a unique id_order
    //     $id_order = 'ORD-' . strtoupper(Str::random(8));

    //     // Retrieve the customer data from the session
    //     $customer = session('nama_customer');
    //     $id_user = auth()->id(); // Assumes users are authenticated
    //     $total_harga = 0;

    //     // Decode cart data from the form
    //     $cart = json_decode($request->input('cartData'), true);

    //     // Calculate the total price based on cart data
    //     foreach ($cart as $item) {
    //         $total_harga += $item['harga'] * $item['kuantitas'];
    //     }

    //     // Save order to 'orders' table
    //     $order = Order::create([
    //         'id_order' => $id_order,
    //         'id_user' => $id_user,
    //         'customer' => $customer,
    //         'meja' => $nomorMeja,
    //         'status' => 'Pending', // Initial status
    //         'total_harga' => $total_harga,
    //         'waktu_transaksi' => Carbon::now(),
    //     ]);

    //     // Save each item in 'detail_orders' table
    //     foreach ($cart as $item) {
    //         DetailOrder::create([
    //             'id_detailorder' => 'DET-' . strtoupper(Str::random(6)),
    //             'id_order' => $id_order,
    //             'id_menus' => $item['id_menu'],
    //             'kuantitas' => $item['kuantitas'],
    //             'harga' => $item['harga'],
    //         ]);
    //     }

    //     return redirect()->route('order.complete', ['nomorMeja' => $nomorMeja])
    //                      ->with('success', 'Order has been successfully placed!');
    // }

    // // Menampilkan halaman tanda terima atau invoice setelah submit order
    // public function showReceipt($nomorMeja, $order)
    // {
    //     $orderData = Order::with('detailOrders')->findOrFail($order);

    //     return view('order.receipt', compact('orderData', 'nomorMeja'));
    // }
}
