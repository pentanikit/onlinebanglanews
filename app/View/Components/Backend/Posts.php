<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Category;

class Posts extends Component
{
    public $posts;
    public $categories;

    public function __construct()
    {
        $search = request('search');  
        $status = request('status');   

        $query = Post::with(['featuredImage', 'category', 'tags'])
            ->latest();

        
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereHas('tags', function ($tagQuery) use ($search) {
                      $tagQuery->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        
        if ($status !== null && $status !== '') {
            $query->whereRaw('LOWER(status) = ?', [strtolower($status)]);
        }

        
        $this->posts = $query->paginate(10)->withQueryString();
        $this->categories = Category::all();
    }

    public function render(): View|Closure|string
    {
        return view('components.backend.posts');
    }
}
