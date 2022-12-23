<?php

namespace App\Http\Livewire\Page\Executive\Approval\Financing;

use App\Models\AccountMaster;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class FinancingCommittee extends Component
{
    public AccountMaster $Account;
    public Approval $Approval;
    public Customer $Customer;
    public User $User;

    protected $rules = [
        'Account.purchase_price'   => 'required',
        'Account.selling_price'    => 'required',
        'Account.approved_duration'=> 'required',
        'Account.instal_amount'    => 'required',
        'Approval.note'            => 'required|max:255',
    ];

    public function next()
    {
        $this->Account->apply_step++;
        $this->Account->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list');
    }

    public function back()
    {
        if ($this->Account->apply_step > 1){
            $this->Account->apply_step--;
            $this->Account->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');

            return redirect()->route('application.list');
        } else {
            $this->dispatchBrowserEvent('swal',[
                'title' => 'Error!',
                'text'  => 'Application cant go back anymore',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 3500,
            ]);
        }
    }

    public function cancel()
    {
        //
    }

    public function debug()
    {
        dd([
            'Account'  => $this->Account,
            'Approval' => $this->Approval,
            'approvals'=> $this->Account->approvals,
        ]);
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Account  = AccountMaster::where('uuid', $uuid)->firstOrFail();
        $this->Approval = Approval::where([['approval_id', $this->Account->id],['order', $this->Account->apply_step]])->firstOrFail();
        $this->Customer = Customer::find($this->Account->cust_id);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.financing.committee')->extends('layouts.head');
    }
}
