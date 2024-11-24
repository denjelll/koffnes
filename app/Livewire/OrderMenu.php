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
    public $bundlingMenu = null;
    public $categories = [];
    public $selectedCategory = null;
    public $cart = [];
    public $search = '';
    public $totalHarga = 0;

    protected $listeners = [
        'updatedSearch',
    ];
    

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

        // Jika tidak ada kategori yang dipilih
        if (is_null($this->selectedCategory)) {
            $this->menus = Menu::with(['promo' => function ($query) use ($now) {
                $query->where('status', 'Aktif')
                    ->where(function ($subQuery) use ($now) {
                        $subQuery->where('hari', 'AllDay')
                                ->orWhere('hari', $now->format('l'));
                    })
                    ->whereTime('waktu_mulai', '<=', $now->format('H:i'))
                    ->whereTime('waktu_berakhir', '>=', $now->format('H:i'));
            }])
            ->where('stock', '>', 0) // Hanya menu dengan stock > 0
            ->get();

            // Filter menu yang memiliki promo untuk bagian Promo Hari Ini
            $this->promoMenus = $this->menus->filter(function ($menu) use ($now) {
                return $menu->promo && 
                    ($menu->promo->hari === 'AllDay' || $menu->promo->hari === $now->format('l')) &&
                    $now->between($menu->promo->waktu_mulai, $menu->promo->waktu_berakhir);
            });

            Log::info('Promo Menus:', [json_encode($this->promoMenus, JSON_PRETTY_PRINT)]);

        } else {
            // Jika kategori dipilih
            $menuIds = Isi_kategori::where('id_kategori', $this->selectedCategory)
                ->pluck('id_menu');

            $this->menus = Menu::with('promo')
                ->whereIn('id_menu', $menuIds)
                ->where('stock', '>', 0) // Hanya menu dengan stock > 0
                ->get();
        }

        // Terapkan harga promo langsung pada data menu
        $this->menus->transform(function ($menu) use ($now) {
            if ($menu->promo &&
                $menu->promo->status === 'Aktif' &&
                ($menu->promo->hari === 'AllDay' || $menu->promo->hari === $now->format('l')) &&
                $now->between($menu->promo->waktu_mulai, $menu->promo->waktu_berakhir)) {
                $menu->harga = $menu->promo->harga_promo;
            }
            return $menu;
        });

        //Ambil bundling menu
        $this->bundlingMenu = Isi_kategori::where('id_kategori', 4) // Filter kategori id_kategori = 4
        ->whereHas('menu', function ($query) {
            $query->where('stock', '>', 0); // Filter menu dengan stok > 0
        })
        ->inRandomOrder() // Pilih secara acak
        ->first()?->menu; // Ambil menu terkait (null-safe operator untuk mencegah error)

        Log::info('Bundling Menu:', [json_encode($this->bundlingMenu, JSON_PRETTY_PRINT)]);

    }

    public function updatedSearch($value)
    {
        $this->searchMenu($value);
    }


    public function searchMenu($keyword)
    {
        $now = Carbon::now();
 
        // Query untuk pencarian menu berdasarkan nama_menu
        $this->menus = Menu::with(['promo' => function ($query) use ($now) {
            $query->where('status', 'Aktif')
                ->where(function ($subQuery) use ($now) {
                    $subQuery->where('hari', 'AllDay')
                            ->orWhere('hari', $now->format('l'));
                })
                ->whereTime('waktu_mulai', '<=', $now->format('H:i'))
                ->whereTime('waktu_berakhir', '>=', $now->format('H:i'));
        }])
        ->where('stock', '>', 0) // Hanya menu dengan stock > 0
        ->where('nama_menu', 'like', '%' . $keyword . '%') // Filter berdasarkan keyword
        ->get();

        // Terapkan harga promo pada hasil pencarian
        $this->menus->transform(function ($menu) use ($now) {
            if ($menu->promo &&
                $menu->promo->status === 'Aktif' &&
                ($menu->promo->hari === 'AllDay' || $menu->promo->hari === $now->format('l')) &&
                $now->between($menu->promo->waktu_mulai, $menu->promo->waktu_berakhir)) {
                $menu->harga = $menu->promo->harga_promo;
            }
            return $menu;
        });

        Log::info('Search Results:', [json_encode($this->menus, JSON_PRETTY_PRINT)]);
    }


    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->fetchMenus();
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
        if ($this->search) {
            $this->searchMenu($this->search);
        } else {
            $this->fetchMenus();
        }

        return view('livewire.order-menu',[
            'menus' => $this->menus
        ])
            ->title('Order Menu');
    }
}
