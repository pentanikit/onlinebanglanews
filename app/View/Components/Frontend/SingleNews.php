<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class SingleNews extends Component
{
    /**
     * Create a new component instance.
     */
    public $singlePost;

    public function __construct(Post $post)
    {
        
        $this->singlePost = $post;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.single-news');
    }
}
