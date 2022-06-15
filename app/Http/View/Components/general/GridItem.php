<?php

namespace App\Http\View\Components\general;

use Illuminate\View\Component;

class GridItem extends Component
{
    public $mobile;
    public $sm;
    public $md;
    public $lg;
    public $xl;

    public function __construct($mobile, $sm, $md, $lg, $xl)
    {
        $this->mobile = $mobile;
        $this->sm = $sm;
        $this->md = $md;
        $this->lg = $lg;
        $this->xl = $xl;
    }
    
    public function render()
    {
        return view('components.general.grid-item');
    }
}
