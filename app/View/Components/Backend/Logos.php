<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Media;

class Logos extends Component
{
    /**
     * Create a new component instance.
     */
    public $logo;
    public $favicon;
    public function __construct()
    {
        $this->logo = Media::where('alt_text', 'logo')->pluck('file_path');
        $this->favicon = Media::where('alt_text', 'favicon')->pluck('file_path');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.logos');
    }
}
