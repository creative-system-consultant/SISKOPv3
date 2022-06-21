<?php

namespace App\Http\View\Components\general;

use Illuminate\View\Component;

class HeaderTitle extends Component
{
    public $route;
    public $title;
    public function __construct($route,$title)
    {
        $this->route = $route;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.general.header-title');
    }
}
