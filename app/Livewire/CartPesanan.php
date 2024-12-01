<?php

namespace App\Livewire;

use App\Events\PesananBaru;
use App\Models\AddOn;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\DetailAddon;
use Illuminate\Support\Str;

class CartPesanan extends Component
{
    public $pesanan = [];
    public $customer = [
        'nama' => '',
        'tipe_order' => '',
        'meja' => 0
    ];
    public $addOns = [];
    public $addOnQty = [];
    public $totalHarga = 0;

    public function mount()
    {
        // Ambil data pesanan dari session
        $this->pesanan = Session::get('pesanan', []);
        $this->customer = Session::get('customer', $this->customer);

        // Ambil Add-On yang berkaitan dengan pesanan
        foreach ($this->pesanan as $item) {
            $this->addOns[$item['id_menu']] = AddOn::where('id_menu', $item['id_menu'])->get();
        }

        // Inisialisasi kuantitas Add-On
        foreach ($this->addOns as $menuId => $addons) {
            foreach ($addons as $addon) {
                $this->addOnQty[$addon->id_addon] = 0;
            }
        }

        // Hitung total harga
        $this->updateTotalHarga();
    }

    // Buat Edit Data Customer
    public function updatedCustomer()
    {
        Session::put('customer', $this->customer);
        session()->flash('success', 'Informasi customer berhasil diperbarui.');
    }

    // Tambah kuantitas pesanan
    public function tambahQty($id_menu)
    {
        $menu = Menu::find($id_menu);
        foreach ($this->pesanan as &$item) {
            if ($item['id_menu'] == $id_menu) {
                if ($item['kuantitas'] < $menu->stock){
                    $item['kuantitas']++;
                    $item['total'] = $item['kuantitas'] * $item['harga'];
                } else {
                    session()->flash('error', 'Stok tidak mencukupi untuk menambah kuantitas.');
                }
            }
        }

        // Simpan kembali ke session
        Session::put('pesanan', $this->pesanan);
        $this->updateTotalHarga();
    }

    // Kurangi kuantitas pesanan
    public function kurangQty($id_menu)
    {
        foreach ($this->pesanan as $key => &$item) {
            if ($item['id_menu'] == $id_menu) {
                if ($item['kuantitas'] > 1) {
                    $item['kuantitas']--;
                    $item['total'] = $item['kuantitas'] * $item['harga'];
                } else {
                    unset($this->pesanan[$key]); // Hapus item jika kuantitas jadi 0
                }
            }
        }

        // Simpan kembali ke session
        Session::put('pesanan', $this->pesanan);
        $this->updateTotalHarga();
    }

    // Tambah kuantitas Add-On
    public function tambahAddOnQty($id_addon)
    {
        if (isset($this->addOnQty[$id_addon])) {
            $this->addOnQty[$id_addon]++;
            $this->updateTotalHarga();
        }
    }

    // Kurangi kuantitas Add-On
    public function kurangAddOnQty($id_addon)
    {
        if (isset($this->addOnQty[$id_addon]) && $this->addOnQty[$id_addon] > 0) {
            $this->addOnQty[$id_addon]--;
            $this->updateTotalHarga();
        }
    }

    // Hapus item dari pesanan
    public function hapusItem($id_menu)
    {
        foreach ($this->pesanan as $key => $item) {
            if ($item['id_menu'] == $id_menu) {
                unset($this->pesanan[$key]); // Hapus item dari pesanan
            }
        }

        // Hapus Add-Ons yang terkait dengan menu
        if (isset($this->addOns[$id_menu])) {
            foreach ($this->addOns[$id_menu] as $addon) {
                unset($this->addOnQty[$addon->id_addon]);
            }
            unset($this->addOns[$id_menu]);
        }

        Session::put('pesanan', $this->pesanan);
        $this->updateTotalHarga();
    }

    // Hitung total harga
    private function updateTotalHarga()
    {
        $this->totalHarga = 0;

        // Hitung total harga pesanan
        foreach ($this->pesanan as $item) {
            $this->totalHarga += $item['total'];
        }

        // Hitung total harga Add-On
        foreach ($this->addOns as $menuId => $addons) {
            foreach ($addons as $addon) {
                $this->totalHarga += $this->addOnQty[$addon->id_addon] * $addon->harga;
            }
        }
    }

    //Tombol Open Bill
    public function openBill()
    {
        if (empty($this->pesanan)) {
            session()->flash('error', 'Tidak ada pesanan untuk disimpan.');
            return;
        }

        //Antrian
        $today = now()->toDateString();
        $lastAntrian = Order::whereDate('waktu_transaksi', $today)->count();
        $currentAntrian = $lastAntrian + 1;

        // Generate ID Order unik
        $id_order = 'ORD-' . strtoupper(Str::random(5));

        // Simpan ke tabel orders
        $order = Order::create([
            'id_order' => $id_order,
            'id_user' => 1, // Asumsikan pengguna saat ini login
            'antrian' => $currentAntrian,
            'customer' => $this->customer['nama'],
            'meja' => $this->customer['meja'],
            'tipe_order' => $this->customer['tipe_order'],
            'status' => 'Open Bill',
            'total_harga' => $this->totalHarga,
            'waktu_transaksi' => now(),
        ]);

        // Simpan detail order ke detail_orders
        foreach ($this->pesanan as $menu) {
            $menuDb = Menu::find($menu['id_menu']);
            if ($menuDb) {
                $menuDb->stock -= $menu['kuantitas'];
                if ($menuDb->stock < 0) {
                    session()->flash('error', 'Stok tidak mencukupi untuk menyimpan pesanan.');
                    return;
                }
                $menuDb->save();
            }

            $id_detailorder = 'DO-' . strtoupper(Str::random(5));
            $detailOrder = DetailOrder::create([
                'id_detailorder' => $id_detailorder,
                'id_order' => $id_order,
                'id_menu' => $menu['id_menu'],
                'kuantitas' => $menu['kuantitas'],
                'harga_menu' => $menu['harga'],
                'notes' => $menu['notes'] ?? '',
                'waktu_transaksi' => now(),
            ]);

            // Simpan Add-On ke detail_addons jika ada
            if (isset($this->addOns[$menu['id_menu']])) {
                foreach ($this->addOns[$menu['id_menu']] as $addon) {
                    if ($this->addOnQty[$addon->id_addon] > 0) {
                        DetailAddon::create([
                            'id_detailaddon' => 'DA-' . strtoupper(Str::random(5)),
                            'id_addon' => $addon->id_addon,
                            'id_detailorder' => $id_detailorder,
                            'kuantitas' => $this->addOnQty[$addon->id_addon],
                            'harga' => $addon->harga,
                            'waktu_transaksi' => now(),
                        ]);
                    }
                }
            }
        }

        //Event listener
        event(new PesananBaru($order));

        // Hapus sesi
        $this->pesanan = [];
        $this->addOns = [];
        $this->addOnQty = [];
        Session::forget('pesanan');
        Session::forget('customer');

        session()->flash('success', 'Pesanan berhasil disimpan.');
        $this->updateTotalHarga(); // Reset total harga
        return redirect()->route('dashboard');
    }

    public function payment()
    {
        // Kirim pesanan dan add-on ke halaman payment
        $pesananAddOn = [];

        foreach ($this->pesanan as $menu) {
            if (isset($this->addOns[$menu['id_menu']])) {
                foreach ($this->addOns[$menu['id_menu']] as $addon) {
                    if ($this->addOnQty[$addon->id_addon] > 0) {
                        $pesananAddOn[] = [
                            'nama_addon' => $addon->nama_addon,
                            'harga' => $addon->harga,
                            'kuantitas' => $this->addOnQty[$addon->id_addon],
                            'total' => $this->addOnQty[$addon->id_addon] * $addon->harga,
                        ];
                    }
                }
            }
        }

        return redirect()->route('payment')->with([
            'pesanan' => $this->pesanan,
            'pesananAddOn' => $pesananAddOn,
            'totalHarga' => $this->totalHarga,
        ]);
    }


    public function render()
    {
        return view('livewire.cart-pesanan', [
            'pesanan' => $this->pesanan,
            'addOns' => $this->addOns,
            'addOnQty' => $this->addOnQty,
            'totalHarga' => $this->totalHarga,
        ])->title('Cart Pesanan');
    }
}
