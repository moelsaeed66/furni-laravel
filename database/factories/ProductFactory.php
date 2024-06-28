<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_id=Category::pluck('id')->toArray();
        return [
            'name'=>fake()->name(),
            'slug'=>fake()->slug(),
            'description'=>fake()->text(200),
            'price'=>fake()->randomFloat(1,2,1000),
            'category_id'=>fake()->randomElement($category_id),
            'image'=>'/product-'.rand(1, 3).'.png'


        ];
    }
}
