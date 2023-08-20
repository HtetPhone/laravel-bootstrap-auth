<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $title = fake()->sentence();
        $description = fake()->paragraph(25);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $description ,
            'excerpt' => Str::words($description, 10, "..."),
            'author_id' => rand(1, 11),
            'category_id' => rand(1,5)
        ];
    }
}
