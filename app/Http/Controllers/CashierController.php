<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CashierController extends Controller
{
    public function cashier()
    {
        return view('login');
    }

    public function verify(Request $request)
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

    public function printReceipt(Request $request, $id)
    {
        Log::info('Print Receipt Called for Order ID:', ['id' => $id]);

        // Validasi ID order
        $order = Order::with(['detailOrders.detailAddon', 'cashier'])->find($id);
        if (!$order) {
            Log::error('Order not found:', ['id' => $id]);
            abort(404, 'Order tidak ditemukan.');
        }

        $cashier = $order->cashier;

        // Log data untuk memastikan semuanya benar
        Log::info('Order Data:', $order->toArray());
        Log::info('Cashier Data:', $cashier->toArray());

        // Render view template struk menjadi HTML
        return view('pos_receipt', compact('order', 'cashier'));
    }



}
