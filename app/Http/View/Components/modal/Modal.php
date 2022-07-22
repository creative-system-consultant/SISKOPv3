<?php

namespace App\Http\View\Components\modal;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;
    public $modalActive;
    public $modalSize;
    public $closeBtn;
    public $modalPosition;

    public function __construct($title,$modalActive,$modalSize ,$closeBtn ="yes", $modalPosition="middle")
    {
        $this->title = $title;
        $this->modalActive = $modalActive;
        $this->modalSize = $modalSize;
        $this->closeBtn = $closeBtn;
        $this->modalPosition = $modalPosition;
    }

    public function render()
    {
        return view('components.modal.Modal');
    }
}
