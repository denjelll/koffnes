<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Promo;
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
