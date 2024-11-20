<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Customer_event_home extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.event_home');
    }
}