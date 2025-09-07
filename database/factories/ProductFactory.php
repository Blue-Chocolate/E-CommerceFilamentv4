<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock' => $this->faker->numberBetween(1, 50),
            'category_id' => Category::factory(),
'image' => fake()->randomElement([
    'https://images.unsplash.com/photo-1585386959984-a4155224a1a4', // Headphones
    'https://images.unsplash.com/photo-1559056199-490a1ba8e46e',   // Smartwatch
    'https://images.unsplash.com/photo-1606813902759-1b7d30f9d6b2', // Sneakers
    'https://images.unsplash.com/photo-1621570274797-4f6b87bbff54', // Laptop
    'https://images.unsplash.com/photo-1600185365483-26d7d2ff7bc8', // Gaming controller
    'https://images.unsplash.com/photo-1606813902919-9f84c7f53e65', // Smart speaker
    'https://images.unsplash.com/photo-1556910103-1c02745aae4d',   // Backpack
    'https://images.unsplash.com/photo-1517336714731-489689fd1ca8', // Sunglasses
    'https://images.unsplash.com/photo-1542291026-7eec264c27ff',   // Shoes
    'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f', // iPhone
]),        ];
    }
}
