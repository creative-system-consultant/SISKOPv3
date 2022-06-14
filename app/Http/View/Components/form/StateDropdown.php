<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class StateDropdown extends Component
{
    public $label;
    public $value;
    public $mandatory;

    public function __construct($label, $value, $mandatory = "false")
    {
        $this->label = $label;
        $this->value = $value;
        $this->mandatory = $mandatory;
    }
    public function render()
    {
        return view('components.form.state-dropdown');
    }
}
