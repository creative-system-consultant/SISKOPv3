<?php

namespace App\Http\Livewire\Page\Executive\Approval\BuyShare;

use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class Maker extends Component
{
    public User $User;
    public Approval $Approval;
    public Share $Maker;
    public $banks;

    protected $rules = [
        'Approval.note'      => 'required|max:255',
        'Maker.approved_amt' => 'required',
        'Maker.bank_code'    => 'required',
    ];

    public function next()
    {
        $this->validate();
        $this->Maker->step++;
        $this->Maker->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '2']);
    }

    public function back()
    {
        if ($this->Maker->step > 1){
            $this->Maker->step--;
            $this->Maker->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');

            return redirect()->route('application.list',['page' => '2']);
        } else {
            $this->dispatchBrowserEvent('swal',[
                'title' => 'Error!',
                'text'  => 'No previous step, this is the first Approval step.',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 10000,
            ]);
        }
    }

    public function mount($uuid)
    {
       $this->User      = User::find(auth()->user()->id);
       $this->Maker     = Share::where('uuid', $uuid)->with('customer')->first();
       $this->banks     = RefBank::where('client_id', $this->Maker->client_id)->where('status', '1')->orderby('priority','asc')->orderby('description')->get();
       $this->Approval  = Approval::where([
            ['approval_id', $this->Maker->id],
            ['order', $this->Maker->step],
            ['role_id', '1'],
            ['approval_type', 'App\Models\Share'],
        ])->firstOrFail();
        //dd($this->Maker->approvals);
    }

    public function deb() {
        dd([
            'banks' => $this->banks,
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-maker')->extends('layouts.head');
    }
}
