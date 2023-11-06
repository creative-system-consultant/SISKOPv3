<?php

namespace App\Http\View\Components\form;

use Illuminate\View\Component;

class Address extends Component
{
    public $label;
    public $name1;
    public $name2;
    public $name3;
    public $name4;
    public $name5;
    public $name6;
    public $condition;
    public $state;
    public $mandatory;
    public $disable;
    public $mailFlag;

    public function __construct(
        $label,
        $name1,
        $name2,
        $name3,
        $name4,
        $name5,
        $name6,
        $condition,
        $mandatory="false",
        $disable="false",
        $mailFlag="false",
    )
    {
        $this->label = $label;
        $this->name1 = $name1;
        $this->name2 = $name2;
        $this->name3 = $name3;
        $this->name4 = $name4;
        $this->name5 = $name5;
        $this->name6 = $name6;
        $this->condition = $condition;
        $this->mandatory = $mandatory;
        $this->disable = $disable;
        $this->mailFlag = $mailFlag;
        // $this->state = RefState::all();
        $this->state = "";
    }

    public function render()
    {
        return view('components.form.address');
    }
}
