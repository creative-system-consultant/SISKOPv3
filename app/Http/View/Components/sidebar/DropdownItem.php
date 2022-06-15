<?php

namespace App\Http\View\Components\sidebar;

use Illuminate\View\Component;

class DropdownItem extends Component
{
    
    public $title;
    public $uri;

    public function __construct($title,$uri)
    {
        
        $this->title = $title;
        $this->uri = $uri;
        
    }


    public function render()
    {
        return view('components.sidebar.dropdown-item');
    }
}
