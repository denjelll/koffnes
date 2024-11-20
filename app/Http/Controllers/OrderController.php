<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
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
        // Validasi session
        if (!session()->has('nama_customer') || session('meja') != $nomorMeja) {
            return redirect()->route('order.formMeja', ['nomorMeja' => $nomorMeja])
                ->with('error', 'Silakan isi data terlebih dahulu.');
        }
    
        // Ambil data dari session
        $customer = session('nama_customer');
        $cart = session('cart', []);
        $menus = Menu::all();
        
        Log::info('Cart di showMenu ' . json_encode($cart, JSON_PRETTY_PRINT)); 

        // Pastikan data cart sesuai dengan menu yang ada
        if(!empty($cart))
        {
            foreach ($cart as &$item) {
                $item['menu'] = Menu::find($item['id_menu']);
            }
        }
    
        return view('orderMenu', compact('customer', 'nomorMeja', 'menus', 'cart'));
    }

    public function orderSuccess($id_order)
    {
        // Ambil data order berdasarkan ID
        $order = Order::with(['detailOrders.menu', 'detailOrders.detailAddon.addon'])->where('id_order', $id_order)->first();

        // Jika order tidak ditemukan, kembalikan view dengan pesan error
        if (!$order) {
            return view('orderSuccess', [
                'id_order' => $id_order,
                'order' => null, // Tidak ada order
            ]);
        }

        // Kembalikan view dengan data order
        return view('orderSuccess', [
            'id_order' => $id_order,
            'order' => $order,
        ]);
    }

    
}
