<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = User::factory()->create([
            'name' => 'John Doe'
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id
        ]);
        // using post factory we can create a post with a corresponding user and category
        // Post::factory(5)->create();

     
        // Truncate before running a seed to avoid duplicates
        // User::truncate();
        // Category::truncate();
        // Post::truncate();

        // $user = User::factory()->create();

        

        // $portfolio = Category::create([
        //     'name' => 'Portfolio',
        //     'slug' => 'portfolio'
        // ]);

        // $painting = Category::create([
        //     'name' => 'Painting',
        //     'slug' => 'painting'
        // ]);

        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // $portfolioPost = Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $portfolio->id,
        //     'title' => 'My Portfolio Post',
        //     'slug' => 'my-portfolio-post',
        //     'excerpt' => '<p>Lorem ipsum dolar sit amet.</p>',
        //     'body' => '<p>Lorem ipsum dolar sit amet. Lorem ipsum dolar sit amet. Lorem ipsum dolar sit amet. Lorem ipsum dolar sit amet</p>'
        // ]);

        // $paintingPost = Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $painting->id,
        //     'title' => 'My Painting Post',
        //     'slug' => 'my-painting-post',
        //     'excerpt' => '<p>Lorem ipsum dolar sit amet.</p>',
        //     'body' => '<p>Lorem ipsum dolar sit amet. Lorem ipsum dolar sit amet. Lorem ipsum dolar sit amet. Lorem ipsum dolar sit amet</p>'
        // ]);
    }
}
