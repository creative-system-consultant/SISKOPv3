<?php

namespace App\Http\Livewire\Page\Executive\Approval\SellShare;

use App\Models\Ref\RefBank;
use App\Models\Share;
use Livewire\Component;

class SellShareApproval extends Component
{
    public $approve;
    public $banks;

    public function submit()
    {
        session()->flash('message', 'Share reimbursement application has been successfully approved');
        session()->flash('success');
        session()->flash('title');  

        return redirect()->route('application.list');
    }

    public function mount($uuid)
    {
       $this->approve = Share::where('uuid', $uuid)->with('customer')->first();
       $this->banks = RefBank::where('coop_id', $this->approve->coop_id)->get(); 
    }

    public function render()
    {
        return view('livewire.page.executive.approval.sellShare.sell-share-approval')->extends('layouts.head');
    }
}
