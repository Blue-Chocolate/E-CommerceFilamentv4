<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory; // ✅ This enables Product::factory()

    protected $fillable = ['name', 'description', 'price', 'category_id', 'stock', 'image'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function scopeWithTopSelling($query)
    {
        return $query
            ->select('products.*')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->orderBy('products.id');
    }
}
