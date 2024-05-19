<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SuccessPage extends Component
{
    public $orderId;
    public $order;
    public $address;

    public function mount($order)
    {
        $this->orderId = $order;
        
        $this->order = Order::findOrFail($this->orderId);

        if ($this->order->user_id !== Auth::id()) {
            abort(404, 'Not Found');
        }

        $this->address = Address::where('order_id', $this->orderId)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.success-page', [
            'order' => $this->order,
            'address' => $this->address,
        ]);
    }
}
