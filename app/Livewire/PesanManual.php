<?php
namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;

class PesanManual extends Component
{
    public $items = [];
    public $qty = [];
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

    public function render()
    {
        return view('livewire.pesan-manual');
    }
}
