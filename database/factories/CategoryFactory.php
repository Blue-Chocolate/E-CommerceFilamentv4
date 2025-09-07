<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            // Generates fake name and slug for category
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
        ];
    }
}