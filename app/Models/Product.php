<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'images',
        'price',
        'sale_price',
        'description',
        'category_id',
        'brand_id',
        'is_active',
        'is_featured',
        'is_stock',
        'on_sale'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
