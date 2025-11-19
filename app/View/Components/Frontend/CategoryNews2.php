<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Category;

class CategoryNews2 extends Component
{
    public $categoriesNews2;
    public $catTitle2;

    /**
     * Create a new component instance.
     */
    public function __construct(string $slug)
    {
        // Find category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Store title for view if needed
        $this->catTitle2 = $category->name ?? $category->title ?? $category->slug;

        // Load posts for this category
        $this->categoriesNews2 = Post::where('category_id', $category->id)
            ->latest()
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.category-news2');
    }
}


