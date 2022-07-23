<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Share as ApplyShare;
use Livewire\Component;

class Share extends Component
{
    public $shares, $custApply;

    public function showApplication($uuid)
    {
        $this->custApply = ApplyShare::where('uuid', $uuid)->with('customer')->first();     
    }
    
    public function mount()    
    { 
        $this->shares = ApplyShare::where('direction', 'buy')->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.share');
    }
}
