<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Models\DetailOrder;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function showTableForm($tableNumber) 
    {
        return view('order.table', compact('tableNumber'));
    }

    public function storeCustomer(Request $request, $tableNumber)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
        ]);

        session([
            'customer_name' => $request->customer_name,
            'table' => $tableNumber,
        ]);

        return redirect()->route('order.ShowMenu', ['table' => $tableNumber]);
    }

    public function showMenu($tableNumber)
    {
        $menus = Menu::all();

        $customer_name = session('customer_name');

        return view('order.menu', compact('menus', 'tableNumber', 'customer_name'));
    }

    public function checkout(Request $request, $tableNumber)
    {
        $request->validate([
            'menu_id' => 'required|array',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $customer_name = session('customer_name');

        $today = Carbon::today();
        $lastOrder = Order::whereDate('created_at', $today)
                          ->orderBy('antrian', 'desc')
                          ->first();

        $antrian = $lastOrder ? $lastOrder->antrian + 1 : 1;

        $order = new Order();
        $order->id_order = 'ORD' . uniqid();
        $order->customer = $customer_name;
        $order->meja = $tableNumber;
        $order->antrian = $antrian;
        $order->status = 'Open Bill';
        $order->total_harga = 0;
        $order->save();

        $totalHarga = 0;

        foreach ($request->menu_ids as $index => $menu_id) {
            $menu = Menu::findOrFail($menu_id);
            $quantity = $request->quantities[$index];

            $detailOrder = new DetailOrder();
            $detailOrder->id_detailorder = 'DET' . uniqid();
            $detailOrder->id_order = $order->id_order;
            $detailOrder->id_menus = $menu->id_menu;
            $detailOrder->kuantitas = $quantity;
            $detailOrder->harga = $menu->harga * $quantity;
            $detailOrder->save();

            $totalHarga += $menu->harga * $quantity;
        }

        $order->total_harga = $totalHarga;
        $order->save();

        return redirect()->route('order.receipt', ['order' => $order->id_order]);
    }

    public function receipt($orderId)
    {
        $order = Order::with('details.menu')->findOrFail($orderId);

        return view('order.receipt', compact('order'));
    }
}
