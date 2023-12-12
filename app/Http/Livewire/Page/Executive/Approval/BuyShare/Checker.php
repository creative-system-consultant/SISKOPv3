<?php

namespace App\Http\Livewire\Page\Executive\Approval\BuyShare;

use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class Checker extends Component
{
    public User $User;
    public Approval $Approval;
    public Share $Checker;
    public $bank;
    public $forward = false;
    public $approval_type = 'lulus';
    public $message = 'Application Pre-Approved';

    protected $rules = [
        'Approval.note'      => 'required|max:255',
        'Checker.approved_amt' => 'required',
    ];

    public function forward() {
        $this->validate();
        $this->approval_type = 'Send to next level';
        $this->message       = 'Application send to next level';
        $this->next();
    }

    public function decline() {
        $this->validate();
        $this->approval_type = 'gagal';
        $this->message       = 'Application is reccomended to declined';
        $this->next();
    }

    public function next()
    {
        $this->validate();
        $this->Checker->step++;
        $this->Checker->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->approval_type;
        $this->Approval->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('time', 10000);
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '2']);
    }

    public function back()
    {
        if ($this->Checker->step > 1){
            $this->Checker->step--;
            $this->Checker->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('time', 10000);
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
        $this->User     = User::find(auth()->user()->id);
        $this->Checker  = Share::where('uuid', $uuid)->with('customer')->first();
        $this->bank     = RefBank::where('code', $this->Checker->bank_code)->first()->description;
        $this->Approval = Approval::where([
            ['approval_id', $this->Checker->id],
            ['order', $this->Checker->step],
            ['role_id', '2'],
            ['approval_type', 'App\Models\Share'],
        ])->firstOrFail();
        $this->forward  = $this->Approval->rule_forward ?? FALSE;
    }

    public function deb(){
        dd([
            'share'=>$this->Checker,
            'bank' => $this->bank,
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-checker')->extends('layouts.head');
    }
}
