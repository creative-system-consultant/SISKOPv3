<?php

namespace App\Http\View\Components\toaster;

use Illuminate\View\Component;

class Error extends Component
{
    public $title;
    public $message;

    public function __construct($title , $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function render()
    {
        return view('components.toaster.error');
    }
}
