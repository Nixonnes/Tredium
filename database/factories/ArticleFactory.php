<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(40),
            'body' => fake()->paragraphs(6, true),
            'thumbnail_url' => fake()->imageUrl(600, 400),
            'likes' => fake()->numberBetween(0, 1000),
            'slug' => Str::slug(fake()->text(32)),
        ];
    }
}
