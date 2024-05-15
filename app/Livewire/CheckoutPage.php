<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Http\Requests\CheckoutRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Thanh toán - ShopWise')]
class CheckoutPage extends Component
{
    public $full_name;
    public $phone;
    public $city;
    public $district;
    public $address;
    public $payment_method = 'cod';

    public function placeOrder()
    {
        $request = new CheckoutRequest();
        $validationData = $request->livewireRules();

        $this->validate([
            'full_name' => $validationData['rules']['full_name'],
            'phone' => $validationData['rules']['phone'],
            'city' => $validationData['rules']['city'],
            'district' => $validationData['rules']['district'],
            'address' => $validationData['rules']['address'],
            'payment_method' => $validationData['rules']['payment_method'],
        ], $validationData['messages']);

        
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
