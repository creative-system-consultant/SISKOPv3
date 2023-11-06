<?php

namespace App\Http\View\Components\sidebar;

use Illuminate\View\Component;

class DropdownNavItem extends Component
{
    public $active;
    public $title;
    public $uri;
    public $type;

    public function __construct($title,$active,$uri,$type)
    {
        $this->title = $title;
        $this->active = $active;
        $this->uri = $uri;
        $this->type = $type;
    }


    public function render()
    {
        return view('components.sidebar.dropdown-nav-item');
    }
}
