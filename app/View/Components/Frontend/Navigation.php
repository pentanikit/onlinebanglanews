<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class Navigation extends Component
{
    /**
     * Create a new component instance.
     */

    public $nav;

    public function __construct()
    {
        $this->nav = Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.navigation');
    }
}
