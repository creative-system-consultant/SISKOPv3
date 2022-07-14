<?php

namespace App\Http\View\Components\form;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $label;
    public $value;
    public $default;
    public $mandatory;
    public $disable;
    public $name;

    public function __construct($label, $value, $default, $mandatory = "no" ,$disable = "false", $name = "")
    {
        $this->label = $label;
        $this->value = $value;
        $this->default = $default;
        $this->mandatory = $mandatory;
        $this->disable = $disable;
        $this->name     = $name;
    }
    public function render()
    {
        return view('components.form.dropdown');
    }
}
