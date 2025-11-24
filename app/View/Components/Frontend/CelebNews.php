<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Category;

class CelebNews extends Component
{
    public $celebNews;
    public $cats;
    public $catTitle;
    public function __construct()
    {
        $cats = Category::where('slug', 'বিনোদন')->firstOrFail();
        $this->catTitle = $cats->name ?? $cats->title ?? $cats->slug;
        $this->celebNews = Post::where('category_id', $cats->id)->latest()->paginate(10);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.celeb-news');
    }
}
