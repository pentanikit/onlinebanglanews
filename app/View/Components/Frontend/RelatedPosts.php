<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class RelatedPosts extends Component
{
    /**
     * Create a new component instance.
     */
    public $relatedposts;
    public function __construct($id)
    {
        // $this->slug = $slug;
        // $cat = Category::where('name', $slug)->firstOrFail();
        // $this->catTitle = $cat->name ?? $cat->title ?? $cat->slug;
        $this->relatedposts = Post::where('category_id', $id)->latest()->take(3)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.related-posts');
    }
}
