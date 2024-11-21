<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Customer_addons_drink extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.customer_addons_drink');
    }
}