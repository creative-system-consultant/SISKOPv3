<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Contribution as ApplyContribution;
use Livewire\Component;

class Contribution extends Component
{
    public $contribution, $custApply;

    public function showApplication($uuid)
    {
        $this->custApply = ApplyContribution::where('uuid', $uuid)->with('customer')->first();
    }

    public function mount()
    {
        $this->contribution = ApplyContribution::where('direction', 'buy')->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.contribution');
    }
}
