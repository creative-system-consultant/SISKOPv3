<?php

namespace App\Http\View\Components\swall;

use Illuminate\View\Component;

class Info extends Component
{
    public $message;
    public $time;

    public function __construct($message,$time = 10000)
    {
        $this->message = $message;
        $this->time = $time;
    }

    public function render()
    {
        return view('components.swall.info');
    }
}
