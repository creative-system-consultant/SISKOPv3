<?php

namespace App\View\Components\general;

use Illuminate\View\Component;

class Accordion extends Component
{
    public $active;
    public $tab;
    public $bg;
    
    public function __construct($active,$tab,$bg)
    {
        $this->active = $active;
        $this->tab = $tab;
        $this->bg = $bg;
    }

    public function render()
    {
        return view('components.general.accordion');
    }
}
