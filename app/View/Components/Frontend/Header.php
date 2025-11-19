<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Media;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public $headerLogo;
    public function __construct()
    {
        $this->headerLogo = Media::where('alt_text', 'logo')->pluck('file_path');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.header');
    }
}
