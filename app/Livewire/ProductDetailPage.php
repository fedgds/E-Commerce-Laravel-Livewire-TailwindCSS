<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Section\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Chi tiết sản phẩm - ShopWise')]
class ProductDetailPage extends Component
{
    use LivewireAlert;
    public $slug;
    public $quantity = 1;

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {
        if ($this->quantity > 1){
            $this->quantity--;
        }
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }


    public function addToCart($product_id) {
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Thêm vào giỏ thành công!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
           ]);
    }

    public function render()
    {
        $productDetail = Product::where('slug', $this->slug)->firstOrFail();

        $relatedProducts = Product::where('category_id', $productDetail->category_id)
        ->where('id', '!=', $productDetail->id)
        ->limit(4) 
        ->get();
        
        return view('livewire.product-detail-page', [
            'product' => $productDetail,
            'relatedProducts' => $relatedProducts
        ]);
    }
}
