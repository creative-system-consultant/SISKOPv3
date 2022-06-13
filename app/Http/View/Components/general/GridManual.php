<?php

namespace App\View\Components\general;

use Illuminate\View\Component;

class GridManual extends Component
{
    public $gap;
    
    public function __construct( $gap )
    {
        $this->gap = $gap;
    }

    public function render()
    {
        return view('components.general.grid-manual');
    }
}
