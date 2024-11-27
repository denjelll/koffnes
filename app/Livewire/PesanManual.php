<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

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

    public function mount()
    {
        $this->items = Menu::all();

        // Inisialisasi kuantitas menu
        foreach ($this->items as $item) {
            $this->qtyMenu[$item->id_menu] = 0;
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
        foreach ($this->items as $item) {
            $this->totalHarga += $this->qtyMenu[$item->id_menu] * $item->harga;
        }
    }

    // Confirm pesanan dan pindah ke cart
    public function confirmOrder()
    {
        if(empty($this->customer['nama'])) {
            session()->flash('error', 'Nama Harus diisi.');
            return;
        }
        if($this->customer['tipe_order'] == 'Take Away') {
            $this->customer['meja'] = 0;
        }


        $this->pesanan = [];
        
        // Loop untuk menyimpan menu yang dipesan saja
        foreach ($this->items as $item) {
            if ($this->qtyMenu[$item->id_menu] > 0) {
                $this->pesanan[] = [
                    'id_menu' => $item->id_menu,
                    'nama_menu' => $item->nama_menu,
                    'kuantitas' => $this->qtyMenu[$item->id_menu],
                    'harga' => $item->harga,
                    'total' => $this->qtyMenu[$item->id_menu] * $item->harga
                ];
            }
        }

        // Simpan ke dalam session
        Session::put('pesanan', $this->pesanan);
        Session::put('customer', $this->customer);

        // Redirect ke halaman keranjang atau pesanan
        return redirect()->route('cart-pesanan');
    }

    public function render()
    {
        return view('livewire.pesan-manual')
            ->title('Pesan Manual');
    }
}
