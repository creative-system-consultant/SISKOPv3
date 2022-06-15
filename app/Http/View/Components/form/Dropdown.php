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

    public function __construct($label, $value, $default, $mandatory = "no" ,$disable = "false")
    {
        $this->label = $label;
        $this->value = $value;
        $this->default = $default;
        $this->mandatory = $mandatory;
        $this->disable = $disable;
    }
    public function render()
    {
        return view('components.form.dropdown');
    }
}
