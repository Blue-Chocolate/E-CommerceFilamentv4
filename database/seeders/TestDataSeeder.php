<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Str;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // --- Create 10 Categories ---
        $categories = [];
        for ($i = 1; $i <= 10; $i++) {
            $categories[] = Category::create([
                'name' => 'Category ' . $i,
                'description' => 'Description for category ' . $i,
            ]);
        }

        // --- Create 50 Products ---
        for ($i = 1; $i <= 50; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'category_id' => $categories[array_rand($categories)]->id,
                'price' => rand(10, 1000), // random price
                'description' => 'Description for product ' . $i,
            ]);
        }

        // --- Create 30 Orders ---
        for ($i = 1; $i <= 30; $i++) {
            Order::create([
                'name' => 'Customer ' . $i,
                'total_amount' => rand(50, 2000),
                'status' => ['Pending', 'Processing', 'Completed', 'Cancelled'][rand(0, 3)],
            ]);
        }
    }
}
