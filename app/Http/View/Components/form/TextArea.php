<?php

namespace App\Http\View\Components\form;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $name;
    public $label;
    public $disable;
    public $mandatory;

    public function __construct($name,$label,$disable="false",$mandatory="false")
    {
        $this->name    = $name;
        $this->label    = $label;
        $this->disable  = $disable;
        $this->mandatory = $mandatory;
    }


    public function render()
    {
        return view('components.form.text-area');
    }
}
