<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Category;

class Posts extends Component
{
    /**
     * Create a new component instance.
     */
    public $posts;
    public $categories;

    public function __construct()
    {
        $this->posts = Post::with(['featuredImage', 'category'])->latest()->paginate(10);
        $this->categories = Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.posts');
    }
}
