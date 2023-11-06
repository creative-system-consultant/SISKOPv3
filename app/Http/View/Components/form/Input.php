<?php

namespace App\Http\View\Components\form;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $value;
    public $type;
    public $mandatory;
    public $disable;
    public $name;

    public function __construct($label, $value, $type="text", $mandatory="false", $disable="false" , $name="")
    {
        $this->label    = $label;
        $this->value    = $value;
        $this->type     = $type;
        $this->mandatory = $mandatory;
        $this->disable  = $disable;
        $this->name     = $name;
    }
    public function render()
    {
        return view('components.form.input');
    }
}
