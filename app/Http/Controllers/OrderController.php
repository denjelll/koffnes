<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;


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
}
