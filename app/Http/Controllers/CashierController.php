<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\KoffnesStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
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

    public function printReceipt(Request $request)
    {
        $request->validate([
            'id_order' => 'required|exists:orders,id_order',
        ]);

        $order = Order::with(['cashier', 'detailOrders.detailAddon.addon'])->findOrFail($request->id_order);

        if (!$order) {
            return redirect()->back()->with('error', 'Order tidak ditemukan.');
        }

        $pdf = Pdf::loadView('pos_receipt', compact('order'))->setPaper([0, 0, 200, 400]); // Ukuran kertas 58mm
        $fileName = 'receipt-' . $order->id_order . '.pdf';

        // Return PDF for browser to print/download
        return $pdf->stream($fileName); // Opens the PDF in the browser for printing
    }


    public function status()
    {
        $status = KoffnesStatus::first();

        return view('statusKoffnes', compact('status'));
    }

    public function toggleStatus()
    {
        $status = KoffnesStatus::first();
        $newStatus = $status->status_koffnes === 'open' ? 'close' : 'open';

        $status->update(['status_koffnes' => $newStatus]);

        // Perbarui cache
        Cache::forget('koffnes_status');
        return back()->with('success', 'Status updated successfully!');
    }



}
