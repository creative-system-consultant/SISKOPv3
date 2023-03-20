<?php

namespace App\Http\Livewire\Page\Executive\Approval\Dividend;

use App\Models\ApplyDividend;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\Dividend;
use App\Models\User;
use Livewire\Component;

class DividendMaker extends Component
{
    public ApplyDividend $Apply;
    public Dividend $Dividend;
    public Approval $Approval;
    public Customer $Cust;
    public User $User;
    public $payout;

    protected $rules = [
        'Apply.div_cash_approved'   => '',
        'Apply.div_share_approved'  => '',
        'Apply.div_contri_approved' => '',
        'Dividend.bal_div'          => '',
        'payout'                    => 'lte:Dividend.bal_div|gt:0',

        'Approval.note'             => 'required|max:255',

    ];

    public function next()
    {
        $this->validate();

        $this->Apply->step++;
        $this->Apply->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        if ($this->Approval->rule_whatsapp){
            $this->Apply->sendWS('SISKOPv3 Application Dividend Payout have been pre-approved by MAKER');
        }

        if ($this->Approval->rule_sms){
            $this->Apply->sendSMS('RM0 SISKOPv3 Application Dividend Payout have been pre-approved by MAKER');
        }

        session()->flash('message', 'Application Dividend Payout Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '7']);
    }

    public function back()
    {
        if ($this->Apply->step > 1){
            $this->Apply->step--;
            $this->Apply->save();

            session()->flash('message', 'Application Dividend Payout Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');

            return redirect()->route('application.list');
        } else {
            $this->dispatchBrowserEvent('swal',[
                'title' => 'Error!',
                'text'  => 'No previous step, this is the first Approval step.',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 3500,
            ]);
        }
    }

    public function debug()
    {
        dd([
            'Dividend' => $this->Apply,
            'Approval' => $this->Approval,
            'approvals'=> $this->Apply->approvals,
        ]);
    }

    public function cancel()
    {
        //
    }

    public function updatePayout()
    {
        $cash   = $this->Apply->div_cash_approved;
        $share  = $this->Apply->div_share_approved;
        $contri = $this->Apply->div_contri_approved;

        $this->payout = $cash + $share + $contri;
    }

    public function mount($uuid)
    {
        $this->User      = User::find(auth()->user()->id);
        $this->Apply     = ApplyDividend::where('uuid', $uuid)->firstOrFail();
        $this->Cust      = Customer::find($this->Apply->cust_id);
        $this->Dividend  = Dividend::where([['coop_id', $this->User->coop_id],['cust_id', $this->Cust->id]])->first();

        $this->Approval  = Approval::where([
            ['approval_id', $this->Apply->id],
            ['approval_type','App\Models\ApplyDividend'],
            ['order', $this->Apply->step]
        ])->firstOrFail();

        if ($this->Apply->div_cash_approved == 0){ $this->Apply->div_cash_approved = $this->Apply->div_cash_apply; }
        if ($this->Apply->div_share_approved == 0){ $this->Apply->div_share_approved = $this->Apply->div_share_apply; }
        if ($this->Apply->div_contri_approved == 0){ $this->Apply->div_contri_approved = $this->Apply->div_contri_apply; }

        $this->updatePayout();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.dividend.maker')->extends('layouts.head');
    }
}
