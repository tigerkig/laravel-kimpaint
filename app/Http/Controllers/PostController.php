<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Livewire\Frontpage;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;


class PostController extends Controller
{    

    /**
     * Show all posts
     *
     * @return void
     */
    public function index()
    {

        $category = Category::firstWhere('slug', request('category'));
        
        if(!$category) {
            $category = ['name' => 'All'];
            // $category->name = 'All';
        }

        $author = User::firstWhere('username', request('author'));
        
        if(!$author) {
            $author = ['name' => 'All'];
            // $category->name = 'All';
        }

        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(4),
            'author' => $author,
            'category' => $category,
        ]);
        
    }
    
        
    /**
     * Display an individual post
     *
     * @return void
     */
    public function show(Post $post)
    {
        // find a post by its slug and pass it to a view called 'post'
        // $post = Post::findOrFail($id);

        // pass the html file to the view
        return view('posts.show', [
            'post' => $post,
            'header' => $post->title,
            'recentPosts' => Post::latest()->take(5)->get(),
            'categories' => Category::all(),
        ]);
    }

}
