<?php
namespace App\Services;

use App\Models\Product;

class AnalyticsService
{
    public static function getTopSellingProducts($limit = 6)
    {
        return Product::select('products.*')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->orderBy('products.id')
            ->limit($limit)
            ->get();
    }
}
