<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CashierController extends Controller
{
    protected function cashier()
    {
        return view('login');
    }

    protected function verify(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('users')->where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Session::put('id_user', $user->id_user);
            Session::put('nama', $user->nama_depan);
            Session::put('role', $user->role);
            return redirect('/cashier');
        } else {
            return redirect('/login');
        }
    }

    protected function inputOrder(Request $request) {
        if(Session::get('role') !== 'cashier') {
            return redirect('/login');
        }

        if($request->isMethod('post')) {
            
            $request->validate([
                'meja' => 'nullable|integer|min:1|max:23',
                'tipe_order' => 'required|in:Dine In,Take Away,Delivery',
                'items.*.id_menu' => 'required|exists:menu,id_menu',
                'items.*.quantity' => 'required|integer|min:1',
            ]);

            $lastQueue = DB::table('orders')
                ->whereDate('waktu_transaksi', now()->toDateString())
                ->max('antrian');

            $newQueue = $lastQueue ? $lastQueue + 1 : 1;

            $totalHarga = 0;
            foreach($request->input('items') as $item) {
                $menu = DB::table('menus')->where('id_menu', $item['id_menu']) -> first();
                $totalHarga += $menu->harga * $item['quantity'];
            }

            $IDorder = uniqid('ORD-');
            DB::table('orders')->insert([
                'id_order' => $IDorder,
                'id_user' => Session::get('id_user'),
                'antrian' => $newQueue,
                'customer' => 'Walk-in Customer',
                'meja' => $request->input('meja'),
                'tipe_order' => $request->input('tipe_order'),
                'status' => 'Open Bill',
                'total_harga' => $totalHarga,
                'waktu_transaksi' => now(),
            ]);

            foreach($request->input('items') as $item) {
                $menu = DB::table('menus')->where('id_menu', $item['id_menu'])->first();
                DB::table('detail_orders')->insert([
                    'id_detailorder' => uniqid('DO-'),
                    'id_order' => $IDorder,
                    'id_menu' => $item['id_menu'],
                    'kuantitas' => $item['quantity'],
                    'harga' => $menu->harga,
                ]);
            }
        }
        return redirect('/cashier');
    }

    protected function dashboard() {
        if(Session::get('role') !== 'cashier') {
            return redirect('/login');
        }
        
        $orders = DB::table('orders')
            ->select('antrian', 'meja', 'tipe_order', 'status', 'total_harga', 'waktu_transaksi')
            ->whereDate('waktu_transaksi', now()->toDateString())
            ->orderBy('antrian', 'asc')
            ->get();

        return view('cashier.dashboard', ['orders' => $orders]);
    }
}
