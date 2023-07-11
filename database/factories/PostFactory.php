<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */

use MarkSitko\LaravelUnsplash\Unsplash;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $unsplash = new Unsplash();
        $picture_url = $unsplash->randomPhoto()
            ->orientation('landscape')
            ->term('programming')->toCollection()['urls']['regular'];


        return [
            'author_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'title' => fake()->sentence,
            'slug' => fake()->slug,
            'excerpt' => fake()->paragraph(5),
            'body' => fake()->paragraph(20),
            'img_url' => $picture_url
        ];
    }
}
