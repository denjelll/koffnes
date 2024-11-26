<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Isi_kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;


class OrderMenu extends Component
{
    public $customer;
    public $nomorMeja;
    public $menus = [];
    public $promoMenus = [];
    public $categories = [];
    public $selectedCategory = null;
    public $cart = [];
    public $search = '';
    public $totalHarga = 0;

    public function mount($nomorMeja)
    {
        // Validasi session
        if (!session()->has('nama_customer') || session('meja') != $nomorMeja) {
            return redirect()->route('order.formMeja', ['nomorMeja' => $nomorMeja])
                ->with('error', 'Silakan isi data terlebih dahulu.');
        }

        $this->customer = session('nama_customer');
        $this->cart = session('cart', []);
        $this->nomorMeja = $nomorMeja;

        // Ambil kategori
        $this->categories= Kategori::all();

        // Ambil semua menu
        $this->fetchMenus();
        $this->calculateTotal();
    }

    public function fetchMenus()
    {
        $now = Carbon::now();

        // Log nilai selectedCategory dan search
        Log::info('Kategori yang dipilih:', [$this->selectedCategory]);
        Log::info('Menu yang dicari:', [json_encode($this->search, JSON_PRETTY_PRINT)]);

        // Reset nilai search setiap kali kategori berubah
        if (!empty($this->selectedCategory) && empty($this->search)) {
            $this->search = ''; // Reset nilai search hanya jika selectedCategory diisi dan search kosong
        }

        // Query awal untuk menu dengan stock > 0
        $query = Menu::with(['promo' => function ($query) use ($now) {
            $query->where('status', 'Aktif')
                ->where(function ($subQuery) use ($now) {
                    $subQuery->where('hari', 'AllDay')
                            ->orWhere('hari', $now->format('l'));
                })
                ->whereTime('waktu_mulai', '<=', $now->format('H:i'))
                ->whereTime('waktu_berakhir', '>=', $now->format('H:i'));
        }])
        ->where('stock', '>', 0); // Filter menu dengan stock > 0

        // Filter berdasarkan pencarian jika ada
        if (!empty($this->search)) {
            $this->selectedCategory = null; // Pastikan kategori di-reset
            Log::info('Menu yang dicari:', [json_encode($this->search, JSON_PRETTY_PRINT)]);
            $query->where('nama_menu', 'like', '%' . $this->search . '%');
            $this->search = '';
        }


        // Reset kategori jika semua dipilih (null)
        if (is_null($this->selectedCategory)) {
            $this->menus = $query->get();
        } else {
            // Filter berdasarkan kategori yang dipilih
            if ($this->selectedCategory == 4) {
                // Khusus bundling
                $this->menus = Isi_kategori::where('id_kategori', 4)
                    ->whereHas('menu', function ($query) {
                        $query->where('stock', '>', 0);
                    })
                    ->with('menu')
                    ->get()
                    ->pluck('menu')
                    ->flatten();

                Log::info('Menu Bundling:', [json_encode($this->menus, JSON_PRETTY_PRINT)]);
            } else {
                $query->whereHas('isi_kategori', function ($q) {
                    $q->where('id_kategori', $this->selectedCategory);
                });

                // Eksekusi query berdasarkan kategori
                $this->menus = $query->get();
            }
        }

        // Filter menu promo untuk bagian Promo Hari Ini
        $this->promoMenus = $this->menus->filter(function ($menu) use ($now) {
            return $menu->promo && 
                ($menu->promo->hari === 'AllDay' || $menu->promo->hari === $now->format('l')) &&
                $now->between($menu->promo->waktu_mulai, $menu->promo->waktu_berakhir);
        });

        Log::info('Promo Menus:', [json_encode($this->promoMenus, JSON_PRETTY_PRINT)]);
    }


    
    public function increment($menuId)
    {
        if (!isset($this->cart[$menuId])) {
            $this->cart[$menuId] = ['id_menu' => $menuId, 'quantity' => 1];
        } else {
            $this->cart[$menuId]['quantity']++;
        }
        $this->updateCart();
    }

    public function decrement($menuId)
    {
        if (isset($this->cart[$menuId])) {
            if ($this->cart[$menuId]['quantity'] > 1) {
                $this->cart[$menuId]['quantity']--;
            } else {
                unset($this->cart[$menuId]);
            }
            $this->updateCart();
        }
    }

    private function updateCart()
    {
        session(['cart' => $this->cart]);
        $this->calculateTotal();

        Log::info('Isi Cart:', [json_encode($this->cart, JSON_PRETTY_PRINT)]);

        
    }

    public function calculateTotal()
    {
        $this->totalHarga = 0;
        $now = Carbon::now();
    
        foreach ($this->cart as $item) {
            $menu = Menu::find($item['id_menu']);
            if ($menu) {
                // Cek apakah ada promo yang berlaku
                if ($menu->promo &&
                    $menu->promo->status === 'Aktif' &&
                    ($menu->promo->hari === 'AllDay' || $menu->promo->hari === $now->format('l')) &&
                    $now->between($menu->promo->waktu_mulai, $menu->promo->waktu_berakhir)) {
                    $harga = $menu->promo->harga_promo;
    
                    // Logging untuk memeriksa harga promo yang diterapkan
                    Log::info('Menggunakan harga promo:', [
                        'id_menu' => $menu->id_menu,
                        'harga' => $harga,
                        'harga_promo' => $menu->promo->harga_promo
                    ]);
                } else {
                    $harga = $menu->harga;
    
                    // Logging untuk memeriksa harga normal
                    Log::info('Menggunakan harga normal:', [
                        'id_menu' => $menu->id_menu,
                        'harga' => $harga
                    ]);
                }
                $this->totalHarga += $harga * $item['quantity'];
            }
        }
    
        // Logging untuk memeriksa total harga yang dihitung
        Log::info('Total Harga yang dihitung:', [json_encode($this->totalHarga, JSON_PRETTY_PRINT)]);
    }
    

    public function render()
    {
        return view('livewire.order-menu')
            ->title('Order Menu');
    }
}
