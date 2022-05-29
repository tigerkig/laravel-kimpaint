<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Footer extends Component
{

    private function menuLinks()
    {
        return DB::table('navigation_menus')
        ->where('type', '=', 'Menu')
        ->orderBy('sequence', 'asc')
        ->orderBy('created_at', 'asc')
        ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer', [
            'menuLinks' => $this->menuLinks()
        ]);
    }
}
