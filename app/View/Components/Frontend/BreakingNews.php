<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class BreakingNews extends Component
{
    /**
     * Create a new component instance.
     */
    public $breaking;

    public function __construct()
    {
        $this->breaking = Post::where('status', 'published')->where('is_breaking', true)->latest()->take(4)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.breaking-news');
    }
}
