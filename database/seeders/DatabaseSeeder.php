<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Database\Factories\BookmarkFactory;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::truncate();
        Category::truncate();
        Comment::truncate();
//        Post::truncate();

       $categories = [
        'Family',
        'Work',
        'Hobbies',
        'Gym',
        'Beauty',
        'Health',
//           'Weather',
//           'Programming',
//           'Sport',
//           'Adventures',
//           'Holidays',
//           'Music',
//           'Cinema',
//           'Anime',
//           'Flowers',
//           'Plants',
//           'Trees',
//           'Ocean',
//           'Fishing',
//           'Cities',
//           'Shopping',
//           'Fairies',
//           'Mountains',
//           'Buildings'
    ];

       foreach ($categories as $category) {
           Category::create([
               'name' => $category,
               'slug' => strtolower($category)
           ]);
       }

        User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => 'password',
        ]);

        User::create([
            'name' => 'John',
            'username' => 'john',
            'email' => 'john@mail.com',
            'password' => 'password',
        ]);

        Post::factory(30)->create();

        Comment::factory(300)->create();

        Bookmark::factory(50)->create();


//        php artisan migrate:refresh --seed
    }
}
