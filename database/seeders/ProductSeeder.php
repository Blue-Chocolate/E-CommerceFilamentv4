<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Run CategorySeeder first.');
            return;
        }

        foreach ($categories as $category) {
            Product::factory()->count(5)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
