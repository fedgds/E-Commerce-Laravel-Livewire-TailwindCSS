<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Sản phẩm - ShopWise')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selected_categories = [];
    #[Url]
    public $selected_brands = [];
    #[Url]
    public $featured;
    #[Url]
    public $on_sale;
    #[Url]
    public $price_range;
    #[Url]
    public $sort;
    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);
    
        $brands = Brand::where('is_active', 1)->get(['id', 'name', 'slug']);
    
        $categories = Category::where('is_active', 1)->get(['id', 'name', 'slug']);
    
        if(!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if(!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        if($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        if($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        switch ($this->sort) {
            case 'latest':
                $productQuery->orderBy('created_at', 'desc');
                break;
            case 'price_asc':
                $productQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $productQuery->orderBy('price', 'desc');
                break;
        }
    
        $products = $productQuery->paginate(9);
    
        return view('livewire.products-page', [
            'products' => $products,
            'brands'   => $brands,
            'categories' => $categories
        ]);
    }
    
}
