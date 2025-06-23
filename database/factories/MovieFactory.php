<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(rand(3, 6));
        $slug = Str::slug($title);

        $category = \App\Models\Category::inRandomOrder()->first();
        if (!$category) {
            $category = \App\Models\Category::factory()->create();
        }

        return [
            'title' => $title,
            'slug' => $slug,
            'synopsis' => fake()->paragraphs(rand(3, 6), true),
            'category_id' => $category->id,
            'year' => fake()->numberBetween(1980, date('Y')),
            'actors' => fake()->name() . ', ' . fake()->name(),
            'cover_image' => 'https://picsum.photos/seed/' . Str::random(10) . '/480/640',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
