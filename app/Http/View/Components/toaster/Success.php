<?php

namespace App\View\Components\toaster;

use Illuminate\View\Component;

class Success extends Component
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
        return view('components.toaster.success');
    }
}
