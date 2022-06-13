<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class InputTag extends Component
{
    public $label;
    public $value;
    public $type;
    public $disable;
    public $mandatory;
    public $leftTag;
    public $rightTag;

    public function __construct($label, $value, $type = "text", $disable = "false" , $mandatory="false", $leftTag , $rightTag , $textred="no")
    {
        $this->label    = $label;
        $this->value    = $value;
        $this->type     = $type;
        $this->disable  = $disable;
        $this->mandatory  = $mandatory;
        $this->leftTag  = $leftTag;
        $this->rightTag  = $rightTag;
    }

    public function render()
    {
        return view('components.form.input-tag');
    }
}
