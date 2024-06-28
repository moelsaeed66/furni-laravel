<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $author_id=User::pluck('id')->toArray();
        return [
            'author_id'=>fake()->randomElement($author_id),
            'title'=>fake()->sentence(5),
            'slug'=>fake()->slug(),
            'image'=>'/post-'.rand(1, 3).'.jpg',
            'description'=>fake()->text(150),


        ];
    }
}
