<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Category;

class HealthNews extends Component
{
    /**
     * Create a new component instance.
     */
    public $healthNews;
    public $cats;
    public $catTitle;
    public function __construct()
    {
        $cats = Category::where('slug', 'health')->firstOrFail();
        $this->catTitle = $cats->name ?? $cats->title ?? $cats->slug;
        $this->healthNews = Post::where('status', 'published')->where('category_id', $cats->id)->latest()->take(4)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.health-news');
    }
}
