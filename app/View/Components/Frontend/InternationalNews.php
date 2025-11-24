<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Category;

class InternationalNews extends Component
{
    /**
     * Create a new component instance.
     */
    public $catTitle;
    public $international;

    public function __construct(string $slug)
    {
        $cat = Category::where('slug', $slug)->firstOrFail();
        $this->catTitle = $cat->name ?? $cat->title ?? $cat->slug;
        
        $this->international =  Post::where('category_id', $cat->id)->with(['author', 'featuredImage'])->latest()->paginate();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.international-news');
    }
}
