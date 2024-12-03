<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PesanManual extends Component
{
    public $items = [];
    public $qtyMenu = [];
    public $totalHarga = 0;
    public $pesanan = [];
    public $customer = [
        'nama' => '',
        'tipe_order' => 'Dine In',
        'meja' => ''
    ];
    public $search = '';

    public function mount()
    {
        $this->customer = Session::get('customer', [
            'nama' => '',
            'tipe_order' => 'Dine In',
            'meja' => ''
        ]);

        $this->items = Menu::with('promo')->get();
        $existingPesanan = Session::get('pesanan', []);

        // Inisialisasi kuantitas menu
        foreach ($this->items as $item) {
            $this->qtyMenu[$item->id_menu] = 0;
        }

        // Jika ada pesanan, isi qtyMenu sesuai dengan data di session
        foreach ($existingPesanan as $pesanan) {
            if (isset($this->qtyMenu[$pesanan['id_menu']])) {
                $this->qtyMenu[$pesanan['id_menu']] = $pesanan['kuantitas'];
            }
        }

        $this->updateTotal();
    }

    // Tambah kuantitas menu
    public function tambahMenu($id)
    {
        if (isset($this->qtyMenu[$id])) {
            $this->qtyMenu[$id]++;
        }
        $this->updateTotal();
    }

    // Kurang kuantitas menu
    public function kurangMenu($id)
    {
        if (isset($this->qtyMenu[$id]) && $this->qtyMenu[$id] > 0) {
            $this->qtyMenu[$id]--;
        }
        $this->updateTotal();
    }

    // Update total harga
    private function updateTotal()
    {
        $this->totalHarga = 0;
        $currentTime = Carbon::now()->format('H:i:s');

        foreach ($this->items as $item) {
            $harga = $item->harga;

            // Cek apakah ada promo aktif
            if ($item->promo 
                && $item->promo->status === 'Aktif' 
                && $currentTime >= $item->promo->waktu_mulai
                && $currentTime <= $item->promo->waktu_berakhir) {
                $harga = $item->promo->harga_promo;
            }

            $this->totalHarga += $this->qtyMenu[$item->id_menu] * $harga;
        }
    }

    // Confirm pesanan dan pindah ke cart
    public function confirmOrder()
    {
        if(empty($this->customer['nama'])) {
            session()->flash('error', 'Nama Harus diisi.');
            return;
        }
        if($this->customer['tipe_order'] == 'Take Away' || $this->customer['tipe_order'] == 'Delivery') {
            $this->customer['meja'] = 0;
        }

        $this->pesanan = [];
        $currentTime = Carbon::now()->format('H:i:s');

        // Loop untuk menyimpan menu yang dipesan saja
        foreach ($this->items as $item) {
            if ($this->qtyMenu[$item->id_menu] > 0) {
                $harga = $item->harga;

                // Cek apakah ada promo aktif
                if ($item->promo 
                    && $item->promo->status === 'Aktif' 
                    && $currentTime >= $item->promo->waktu_mulai
                    && $currentTime <= $item->promo->waktu_berakhir) {
                    $harga = $item->promo->harga_promo;
                }

                $this->pesanan[] = [
                    'id_menu' => $item->id_menu,
                    'nama_menu' => $item->nama_menu,
                    'kuantitas' => $this->qtyMenu[$item->id_menu],
                    'harga' => $harga,
                    'total' => $this->qtyMenu[$item->id_menu] * $harga
                ];
            }
        }

        // Simpan ke dalam session
        Session::put('pesanan', $this->pesanan);
        Session::put('customer', $this->customer);

        // Redirect ke halaman keranjang atau pesanan
        return redirect()->route('cart-pesanan');
    }

    public function searchMenu()
    {
        $this->items = Menu::where('nama_menu', 'like', '%' . $this->search . '%')->with('promo')->get();
    }

    public function render()
    {
        return view('livewire.pesan-manual', [
            'items' => $this->items
        ])
            ->title('Pesan Manual');
    }
}
