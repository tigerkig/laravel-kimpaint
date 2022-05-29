<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Frontpage extends Component
{
    use WithPagination;
    public $urlslug;
    public $title;
    public $content;
    
    /**
     * Livewire mount function
     *
     * @param  mixed $urlslug
     * @return void
     */
    public function mount($urlslug = null)
    {
        $this->retrieveContent($urlslug);
        
    }
    
    /**
     * Fetch record data from database with slug variable
     *
     * @param  mixed $urlslug
     * @return void
     */
    public function retrieveContent($urlslug)
    {
        // Get home page if slug is empty
        if(empty($urlslug)) {
            $data = Page::where('is_default_home', true)->first();
        } else {
            $data = Page::where('slug', $urlslug)->first();
        }

        // if the url slug does not exist, show 404 error
        if(!$data) {
            $data = Page::where('is_default_not_found', true)->first();
        }

        // $data = Page::where('slug',$urlslug)->first();
        $this->title = $data->title;
        $this->content = $data->content;
    }
    
    /**
     * Fetch navigation menu links from database
     *
     * @return void
     */
    private function menuLinks()
    {
        return DB::table('navigation_menus')
        ->where('type', '=', 'Menu')
        ->orderBy('sequence', 'asc')
        ->orderBy('created_at', 'asc')
        ->get();
    }
    private function subMenuLinks()
    {
        return DB::table('navigation_menus')
        ->where('type', '=', 'SubMenu')
        ->orderBy('menuid', 'asc')
        ->orderBy('sequence', 'asc')
        ->orderBy('created_at', 'asc')
        ->get();
    }
    private function recentBlogs()
    {
        return DB::table('posts')
        ->orderBy('created_at', 'desc')
        ->limit(4)
        ->get();
    }
    public function read()
    {
        return Page::paginate(2);
    }
    private function allBlogs()
    {
        return DB::table('blogs')
        ->orderBy('created_at', 'desc')
        ->paginate(1);
    }

    private function testimonials()
    {
        return DB::table('testimonials')
        ->orderBy('created_at', 'desc')
        ->get();
    }
    
    /**
     * Livewire render function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.frontpage', [
            'menuLinks' => $this->menuLinks(),
            'subMenuLinks' => $this->subMenuLinks(),
            'recentBlogs' => $this->recentBlogs(),
            'allBlogs' => $this->allBlogs(),
            'testimonials' => $this->testimonials(),
            'data' => $this->read(),
        ])->layout('layouts.frontpage');
    }
}
