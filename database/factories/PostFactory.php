<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category_id = rand(1, Category::count());
        return [
            'user_id' => rand(1, User::count()),
            'category_id' => $category_id,
            'title' => 'The post about '. Category::find($category_id)->name,
            'slug' => fake()->slug(),
            'excerpt' => '<p>' . implode('</p><p>', fake()->paragraphs(2)) . '</p>',
            'body' => '<p>' . implode('</p><p>', fake()->paragraphs(6)) . '</p>',
            'views_count' => rand(10,3000),
            'created_at' => fake()-> dateTimeBetween('-1 year', 'now'),
        ];
    }
}
