<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function generateDailyReport(Request $request)
    {
        // Ambil order hari ini
        $orders = Order::with(['detailOrders', 'detailOrders.detailAddon'])
        ->whereDate('waktu_transaksi', Carbon::today())
        ->get();

        // Buat PDF menggunakan view dan data orders
        $pdf = PDF::loadView('reports.dailyClosing', compact('orders'));

        // Simpan PDF ke storage
        $filePath = storage_path('app/public/daily_report_' . Carbon::now()->format('Y_m_d') . '.pdf');
        $pdf->save($filePath);

        // Kembalikan URL ke PDF
        return response()->json(url('storage/daily_report_' . Carbon::now()->format('Y_m_d') . '.pdf'));
    }
}
