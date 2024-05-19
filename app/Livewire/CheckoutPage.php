<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Thanh toán - ShopWise')]
class CheckoutPage extends Component
{
    use LivewireAlert;
    public $full_name;
    public $phone;
    public $city;
    public $district;
    public $address;
    public $notes;
    public $payment_method = 'cod';

    public function placeOrder()
    {
        // Validate the request
        $request = new CheckoutRequest();
        $validationData = $request->livewireRules();

        $this->validate([
            'full_name' => $validationData['rules']['full_name'],
            'phone' => $validationData['rules']['phone'],
            'city' => $validationData['rules']['city'],
            'district' => $validationData['rules']['district'],
            'address' => $validationData['rules']['address'],
        ], $validationData['messages']);

        $user = Auth::user();

        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        DB::beginTransaction();

        try {
            // Thêm vào bảng orders
            $order = Order::create([
                'user_id' => $user->id,
                'grand_total' => $grand_total,
                'notes' => $this->notes,
                'payment_method' => $this->payment_method,
            ]);

            // Thêm vào bảng order_items
            foreach ($cart_items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_amount'],
                    'total_price' => $item['total_amount'],
                ]);
            }

            // Thêm vào bảng addresses
            Address::create([
                'order_id' => $order->id,
                'full_name' => $this->full_name,
                'phone' => $this->phone,
                'city' => $this->city,
                'district' => $this->district,
                'address' => $this->address,
            ]);

            // Commit transaction
            DB::commit();

            // Xóa giỏ
            CartManagement::clearCartItems();

            return redirect()->route('order.success', ['order' => $order->id]);
            // $this->alert('success', 'Đặt hàng thành công!', [
            //     'position' => 'center',
            //     'timer' => 3000,
            //     'toast' => true,
            // ]);

        } catch (\Exception $e) {
            // Rollback lại DB
            DB::rollBack();

            $this->alert('error', 'Đã xảy ra lỗi '.$e->getMessage().' khi đặt hàng. Vui lòng thử lại!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
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
