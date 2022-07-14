<?php

namespace App\Http\View\Components\form;

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
    public $name;

    public function __construct($label, $value, $type = "text", $disable = "false" , $mandatory="false", $leftTag , $rightTag , $textred="no", $name="")
    {
        $this->label    = $label;
        $this->value    = $value;
        $this->type     = $type;
        $this->disable  = $disable;
        $this->mandatory  = $mandatory;
        $this->leftTag  = $leftTag;
        $this->rightTag  = $rightTag;
        $this->name     = $name;
    }

    public function render()
    {
        return view('components.form.input-tag');
    }
}
