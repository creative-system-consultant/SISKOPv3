<?php

namespace App\Http\View\Components\sidebar;

use Illuminate\View\Component;

class DropdownNavItem extends Component
{
    public $active;
    public $title;
    public $uri;
    
    public function __construct($title,$active,$uri)
    {
        $this->active = $active;
        $this->title = $title;
        $this->uri = $uri;
    }

    
    public function render()
    {
        return view('components.sidebar.dropdown-nav-item');
    }
}
