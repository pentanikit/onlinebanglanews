<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class LatestNews extends Component
{
    /**
     * Create a new component instance.
     */
    public $latest;

    public function __construct()
    {
        $this->latest = Post::where('status', 'published')->latest()->paginate(10);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.latest-news');
    }
}
