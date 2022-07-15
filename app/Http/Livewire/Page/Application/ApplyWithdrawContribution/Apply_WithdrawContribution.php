<?php

namespace App\Http\Livewire\Page\Application\ApplyWithdrawContribution;

use App\Models\contribution;
use App\Models\Customer;
use App\Models\Ref\RefBank;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Apply_WithdrawContribution extends Component
{
    use WithFileUploads;

    public Customer $cust;
    public $cont_apply;
    public $support_file;
    public $bank_account;
    public $bank_code;
    public $banks;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];        

    protected $rules = [
        'cust.name'                 => 'required',
        'cust.icno'                 => 'required',
        'cust.contribution'         => 'required',
        'cust.contribution_monthly' => 'required',
        'cont_apply'                => 'required|numeric',  
        'support_file'              => 'required',
        'bank_code'                 => 'required',
        'bank_account'              => 'required',
    ];

    protected $messages = [
        'cont_apply.required'         => ':attribute field is required',
        'cont_apply.numeric'          => ':attribute field must be number',
        'support_file.required'       => ':attribute field is required',
        'bank_code.required'          => ':attribute field is required',
        'bank_account.required'       => ':attribute field is required',
    ];

    protected $validationAttributes = [
        'cont_apply'      => 'Add Contribution Applied',
        'support_file'    => 'Upload Supporting Document',
        'bank_code'       => 'Bank',
        'bank_account'    => 'Account Bank No.',
    ];

    public function alertConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',  
            'text'      => 'Are you sure you want to apply for withdrawal contribution?',
        ]);   
    }

    public function submit()
    {
        if ($this->cont_apply <= 0) {
            session()->flash('message', 'Application must be more than RM0');
            session()->flash('warning');
            session()->flash('title');

            return redirect()->route('contribution.withdraw');
        }
        elseif($this->cont_apply > $this->cust['contribution']){
            session()->flash('message', 'Application must be less than RM'.$this->cust['contribution']);
            session()->flash('warning');
            session()->flash('title');

            return redirect()->route('contribution.withdraw');
        }

        $user = auth()->user();
        $customer = Customer::where('icno', $user->icno)->first();
        $contribution = contribution::where([['cust_id', $customer->id], ['flag', 0], ['step', 0], ['direction', 'withdraw']])->first();

        $this->validate();

        $contribution->update([
            'direction'      => 'withdraw',
            'amt_before'     => $this->cust['contribution'] ??= '0',
            'apply_amt'      => $this->cont_apply,
            'approved_amt'   => NULL,
            'bank_code'      => $this->bank_code,
            'bank_account'   => $this->bank_account,
            'flag'           => 1,
            'step'           => 1,
            'created_by'     => strtoupper($customer->name),  
        ]);

        $files = $this->support_file->getClientOriginalName();
        $filename = pathinfo($files, PATHINFO_FILENAME);
        $filepath = 'Files/'.$customer->id.'/'.$filename.'.'.$this->support_file->extension(); 
        
        Storage::disk('local')->putFileAs('public/Files/' . $customer->id. '/', $this->support_file, $filename.'.'.$this->support_file->extension());

        $contribution->files()->create([
            'filename' => $filename,
            'filedesc' => 'Support Document',
            'filetype' => $this->support_file->extension(),
            'filepath' => $filepath,
        ]);

        session()->flash('message', 'Withdrawal Contribution Application Successfully Send');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home'); 
    }

    public function restrictApply($id)   
    {
        $contribution = contribution::where([['cust_id', $id ], ['flag', 1], ['step', 1], ['direction', 'withdraw']])->first();

        if ($contribution != null) {
            session()->flash('message', 'Withdrawal contribution application is been processed. If you want to make another application, please wait until the application is processed');
            session()->flash('info');
            session()->flash('title');
    
            return redirect()->route('home');                                
        }
    }

    public function applyCont($cust_id)
    {
        $contribution = contribution::where('cust_id', $cust_id)->firstOrNew([
            'coop_id'     => $this->cust->coop_id, 
            'cust_id'     => $this->cust->id, 
        ]);


        $contribution->amt_before  = $this->cust->contribution;
        $contribution->direction   = 'withdraw';
        $contribution->step        = 0;
        $contribution->flag        = 0; 
        $contribution->apply_amt   = '0.00';

        $contribution->save();

        $this->cont_apply   = $contribution?->apply_amt;
        $this->bank_account = $contribution?->bank_account;
        $this->bank_code    = $contribution?->bank_code; 
    }

    public function mount()
    {
        $user = auth()->user();
        $this->cust = Customer::where('icno', $user->icno)->first();
        $this->banks = RefBank::where('coop_id', $user->coop_id)->get(); 

        $this->restrictApply($this->cust->id);        
        $this->applyCont($this->cust->id);
    }

    public function render()
    {
        return view('livewire.page.application.apply-withdraw-contribution.apply-withdraw-contribution')->extends('layouts.head');
    }
}
