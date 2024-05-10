<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Chi tiết sản phẩm - ShopWise')]
class ProductDetailPage extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
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
