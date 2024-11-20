<?php
namespace App\Livewire;

use App\Models\Menu;
use App\Models\Order;
use Livewire\Component;
use App\Models\DetailOrder;
use Illuminate\Support\Carbon;

class PesanManual extends Component
{
    public $items = [];
    public $qty = [];
    public $customer, $tipeOrder, $meja;
    public $antrian;
    public $totalHarga = 0;

    public function mount()
    {
        $this->items = Menu::all();

        // Inisialisasi qty untuk setiap item menu
        foreach ($this->items as $item) {
            $this->qty[$item->id_menu] = 0;
        }

        $this->updateTotal();
    }

    // Fungsi untuk menambah kuantitas
    public function tambah($id)
    {
        // Cek apakah qty sudah terinisialisasi
        if (isset($this->qty[$id])) {
            $this->qty[$id]++;
        } else {
            $this->qty[$id] = 1;
        }
        $this->updateTotal();
    }

    // Fungsi untuk mengurangi kuantitas
    public function kurang($id)
    {
        // Pastikan qty lebih besar dari 0 sebelum dikurangi
        if (isset($this->qty[$id]) && $this->qty[$id] > 0) {
            $this->qty[$id]--;
        }
        $this->updateTotal();
    }

    // Fungsi untuk memperbarui total harga
    private function updateTotal()
    {
        $this->totalHarga = 0;
        foreach ($this->items as $item) {
            $this->totalHarga += $this->qty[$item->id_menu] * $item->harga;
        }
    }

    // Fungsi untuk mengonfirmasi pesanan
    public function confirmOrder()
    {
        if (empty($this->customer || $this->tipeOrder)) {
            session()->flash('error', 'Seluruh Field harus diisi!');
            return;
        }

        // Ambil tanggal transaksi dan antrian (auto increment)
        $tanggalTransaksi = Carbon::now()->format('Ymd');
        $lastOrder = Order::where('antrian', '>', 0)->orderBy('antrian', 'desc')->first(); // Ambil antrian terakhir
        $antrian = $lastOrder ? $lastOrder->antrian + 1 : 1; // Antrian dimulai dari 1

        // Membuat id_order berdasarkan format yang diinginkan
        $idOrder = "ORD" . $tanggalTransaksi . "-" . $antrian;

        // Menyimpan data pesanan ke dalam tabel orders
        $order = Order::create([
            'id_order' => $idOrder,
            'id_user' => "NOT PICK UP", // Karena id_user adalah NOT PICK UP, bisa diatur ke null atau ID user lain
            'antrian' => $antrian,
            'customer' => $this->customer,
            'meja' => $this->tipeOrder == 'Dine In' ? $this->meja : 0, // Jika tipe order adalah Take Away, meja diisi null
            'tipe_order' => $this->tipeOrder,
            'status' => 'Open Bill',
            'total_harga' => $this->totalHarga,
            'waktu_transaksi' => Carbon::now(),
        ]);

        // Simpan item menu yang dipesan ke tabel detail_orders
        foreach ($this->items as $item) {
            if ($this->qty[$item->id_menu] > 0) {
                DetailOrder::create([
                    'id_detailorder' => 'OD' . now()->format('Ymd') . '-' . str_pad($antrian, 3, '0', STR_PAD_LEFT),
                    'id_order' => $order->id_order,
                    'id_menu' => $item->id_menu,
                    'kuantitas' => $this->qty[$item->id_menu],
                    'harga_menu' => $item->harga,
                    'notes' => ""
                ]);
            }
        }

        $this->reset('customer', 'tipeOrder', 'meja');
    
        // Inisialisasi kembali kuantitas untuk setiap item menu
        foreach ($this->items as $item) {
            $this->qty[$item->id_menu] = 0; // Reset kuantitas untuk setiap item
        }

        // Perbarui total harga setelah reset
        $this->updateTotal();

        // Menampilkan pesan sukses
        session()->flash('success', 'Pesanan berhasil dibuat!');
    }

    public function render()
    {
        return view('livewire.pesan-manual');
    }
}
