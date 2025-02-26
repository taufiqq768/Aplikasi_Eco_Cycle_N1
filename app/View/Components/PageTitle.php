<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageTitle extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $breadcrumbItems;
    public function __construct($title = 'Page Title', $breadcrumbItems = [])
    {
        $this->title = $title;
        $this->breadcrumbItems = $breadcrumbItems;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-title');
    }
}
