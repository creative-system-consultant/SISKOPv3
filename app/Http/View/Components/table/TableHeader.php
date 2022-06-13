<?php

namespace App\View\Components\table;

use Illuminate\View\Component;

class TableHeader extends Component
{
    public $value;
    public $sort;

    public function __construct($value, $sort)
    {
        $this->value = $value;
        $this->sort = $sort;
    }
    public function render()
    {
        return view('components.table.table-header');
    }
}
