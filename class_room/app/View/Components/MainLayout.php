<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainLayout extends Component
{
    // protected $title; // here we defined it protected so we shall pass it to the view
    // public $title; if we need to define it public we don't need to pass it to the view
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title, $class = '')
    {
        //
        // $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view(
            'layouts.main',
            // ['title' => $this->title,]
        );
    }
}
