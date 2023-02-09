<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //Necessary fields post_id, user_id, body,
            'user_id' => rand(1, User::count()),
            'post_id' => rand(1, Post::count()),
            'body' => '<p>' . implode('</p><p>', fake()->paragraphs(2)) . '</p>',
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),

        ];
    }
}
