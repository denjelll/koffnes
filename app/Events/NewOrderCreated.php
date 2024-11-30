<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOrderCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
        Log::info('NewOrderCreated Event: ', ['order' => $this->order]);
    }

    public function broadcastOn()
    {
        return new Channel('orders');
    }
}
