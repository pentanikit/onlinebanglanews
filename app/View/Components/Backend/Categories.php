<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class Categories extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;

    public function __construct()
    {
        $this->categories = Category::orderBy('order_column')
            ->orderBy('id')
            ->paginate(20);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.categories');
    }
}
