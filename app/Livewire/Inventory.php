<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;

class Inventory extends Component
{
    public $menus;
    public $isAddingStock = false;
    public $menuId;
    public $menuName;
    public $menuStock;
    public $newStock;

    public function mount()
    {
        $this->menus = Menu::all();
    }

    public function openAddStockPopup($id)
    {
        $menu = Menu::findOrFail($id);
        $this->menuId = $menu->id_menu;
        $this->menuName = $menu->nama_menu;
        $this->menuStock = $menu->stock;
        $this->newStock = $menu->stock;
        $this->isAddingStock = true;
    }

    public function saveStock()
    {
        $menu = Menu::findOrFail($this->menuId);
        $menu->stock = $this->newStock;
        $menu->save();

        // Refresh the menu list
        $this->menus = Menu::all();

        // Close popup
        $this->resetPopup();
    }

    public function resetPopup()
    {
        $this->isAddingStock = false;
        $this->menuId = null;
        $this->menuName = null;
        $this->menuStock = null;
        $this->newStock = null;
    }

    public function render()
    {
        return view('livewire.inventory')
            ->title('Inventory');
    }
}
