<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

class BreadCrumb extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // pass current page
        // pass previous page
        // if its a post, pass the name not the slug
        // $category = Category::firstWhere('slug', request('category'));

        // if(!$category) {
        //     $category = null;
        // }
        // $post = get('posts/{post:slug}', [PostController::class, 'show']);
            // $post = PostController::show('hi');
        // $post = new PostController();
        // $post->show('ipsa-praesentium-illo-eligendi-dolorem-dolorem-sunt');
        


        return view('components.bread-crumb', [
            'post' => 'hi'
        ]);
    }
}
