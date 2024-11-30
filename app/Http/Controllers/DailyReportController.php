<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use Carbon\Carbon;

class DailyReportController extends Controller
{
    public function generateDailyReport(Request $request)
    {
        // Ambil data order hari ini
        $orders = Order::with(['cashier', 'detailOrders.detailAddon.addon'])
            ->whereDate('waktu_transaksi', Carbon::today())
            ->get();

        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada transaksi hari ini.');
        }

         // Ambil nama karyawan dari session
        $printedBy = session('nama');

        // Generate PDF menggunakan view
        $pdf = Pdf::loadView('reports.dailyClosing', compact('orders', 'printedBy'))
                ->setPaper('a4', 'landscape');;

        // Set nama file
        $fileName = 'daily-report-koffnes-' . Carbon::today()->format('Y-m-d') . '.pdf';

        return $pdf->download($fileName);
    }
}
