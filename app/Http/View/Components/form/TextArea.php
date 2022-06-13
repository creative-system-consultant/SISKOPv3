<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $value;
    public $label;
    
    public function __construct($value,$label)
    {
        $this->value    = $value;
        $this->label    = $label;
    }

    
    public function render()
    {
        return view('components.form.text-area');
    }
}
