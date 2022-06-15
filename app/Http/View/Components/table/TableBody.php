<?php

namespace App\Http\View\Components\table;

use Illuminate\View\Component;

class TableBody extends Component
{
    public $colspan;

    public function __construct($colspan)
    {
        $this->colspan = $colspan;
    }
    public function render()
    {
        return view('components.table.table-body');
    }
}
