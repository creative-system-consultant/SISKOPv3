<?php

namespace App\Http\View\Components\sidebar;

use Illuminate\View\Component;

class NavItem extends Component
{
    public $title;
    public $route;
    public $uri;

    public function __construct($title,$route,$uri)
    {
        $this->title = $title;
        $this->route = $route;
        $this->uri = $uri;
    }

    
    public function render()
    {
        return view('components.sidebar.nav-item');
    }
}
