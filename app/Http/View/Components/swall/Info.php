<?php

namespace App\Http\View\Components\swall;

use Illuminate\View\Component;

class Info extends Component
{
    public $message;
    
    public function __construct($message)
    {
        $this->message = $message;
    }
    
    public function render()
    {
        return view('components.swall.info');
    }
}
