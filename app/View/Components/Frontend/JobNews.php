<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Category;

class JobNews extends Component
{
    /**
     * Create a new component instance.
     */
    public $jobNews;
    public $cats;
    public $catTitle;
    public function __construct()
    {
        $cats = Category::where('slug', 'jobs')->firstOrFail();
        $this->catTitle = $cats->name ?? $cats->title ?? $cats->slug;
        $this->jobNews = Post::where('status', 'published')->where('category_id', $cats->id)->latest()->paginate(6);
    }

    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.job-news');
    }
}
