<?php

namespace App\Http\Livewire\Page\Application\ApplyShare;

use App\Models\Customer;
use App\Models\Ref\RefBank;
use App\Models\Share;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Apply_Share extends Component
{
    use WithFileUploads;

    public Customer $cust;
    public $share_apply;
    public $pay_method;
    public $online_date;
    public $online_file;
    public $cdm_date;
    public $cdm_file;
    public $cheque_no;
    public $cheque_date;
    public $banks;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];    

    protected $rules = [
        'cust.name'       => 'required',
        'cust.icno'       => 'required',
        'cust.share'      => 'required',
        'share_apply'     => 'required|numeric|not_in:0',
        'pay_method'      => 'required',
        'online_date'     => 'exclude_if:pay_method,==,cash,&&,pay_method,==,cheque,&&,cont_type,null,&&,cont_type,==,cont_date|'.
                             'required_if:pay_method,==,online|before:first day of january next year|after_or_equal:today',
        'online_file'     => 'required_if:pay_method,==,online',
        'cdm_date'        => 'exclude_if:pay_method,==,online,&&,pay_method,==,cheque,&&,cont_type,null,&&,cont_type,==,cont_date|'.
                             'required_if:pay_method,==,cash|before:first day of january next year|after_or_equal:today',
        'cdm_file'        => 'required_if:pay_method,==,cash',
        'cheque_no'       => 'required_if:pay_method,==,cheque',
        'cheque_date'     => 'exclude_if:pay_method,==,online,&&,pay_method,==,cash,&&,cont_type,null,&&,cont_type,==,cont_date|'.
                             'required_if:pay_method,==,cheque|before:first day of january next year|after_or_equal:today',
        'banks'           => 'required',
    ];
    
    protected $messages = [
        'share_apply.required'        => ':attribute field is required',
        'share_apply.not_in'          => 'Application must be more than RM0',
        'pay_method.required'         => ':attribute is required',
        'online_date.required_if'     => ':attribute field is required',
        'online_date.before'          => 'Please enter date in this year',
        'online_date.after_or_equal'  => 'Please enter latest date',
        'online_file.required_if'     => ':attribute field is required',
        'cdm_date.required_if'        => ':attribute field is required',
        'cdm_date.before'             => 'Please enter date in this year',
        'cdm_date.after_or_equal'     => 'Please enter latest date',
        'cdm_file.required_if'        => ':attribute field is required',
        'cheque_no.required_if'       => ':attribute field is required',
        'cheque_date.required_if'     => ':attribute field is required',
        'cheque_date.before'          => 'Please enter date in this year',
        'cheque_date.after_or_equal'  => 'Please enter latest date',
        'banks.required'              => ':attribute field is required',
    ];

    protected $validationAttributes = [
        'share_apply'     => 'Share Capital Increase Applied',
        'pay_method'      => 'Payment Method',
        'online_date'     => 'Online Payment Date',
        'online_file'     => 'Upload Online Payment Receipt',
        'cdm_date'        => 'Cdm Payment Date',
        'cdm_file'        => 'Upload Cdm Payment Receipt',
        'cheque_no'       => 'Cheque No.',
        'cheque_date'     => 'Cheque Date',
        'banks'           => 'Bank',
    ];

    public function alertConfirm()
    {
        $this->validate();
        
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',  
            'text'      => 'Are you sure you want to apply for add share?',
        ]);   
    }

    public function submit()
    {
        $user = auth()->user();
        $customer = Customer::where('icno', $user->icno)->first();
        $share = Share::where([['cust_id', $customer->id], ['flag', 0], ['step', 0], ['direction', 'buy']])->first();

        if ($this->share_apply == 0) {
            session()->flash('message', 'Application must be more than RM0');
            session()->flash('warning');
            session()->flash('title');

            return redirect()->route('share.apply');
        }
        
        $share->update([
            'method'       => $this->pay_method,
            'online_date'  => $this->online_date ??= NULL,
            'cdm_date'     => $this->cdm_date ??= NULL,
            'cheque_date'  => $this->cheque_date ??= NULL,
            'cheque_no'    => $this->cheque_no ??= NULL,
            'amt_before'   => $this->cust['share'] ??= '0',
            'apply_amt'    => $this->share_apply,
            'approved_amt' => NULL,
            'flag'         => 1,
            'step'         => 1,
            'created_by'   => strtoupper($customer->name),  
        ]);

        if ($this->pay_method == 'online') {
            // dd('Online Banking');
            $filepath = 'Files/'.$customer->id.'/share//'.$share->id.'/'.'online_receipt'.'.'.$this->online_file->extension();                    

            Storage::disk('local')->putFileAs('public/Files/'. $customer->id. '/share//'.$share->id.'/', $this->online_file, 'online_receipt'.'.'.$this->online_file->extension());

            $share->files()->create([
                'filename' => 'online_receipt',
                'filedesc' => 'Online Payment Receipt',
                'filetype' => $this->online_file->extension(),
                'filepath' => $filepath,
            ]);

            session()->flash('message', 'Share Application Successfully Send');
            session()->flash('success');
            session()->flash('title');

            return redirect()->route('home');
        }
        elseif ($this->pay_method == 'cash') {
            // dd('CDM');
            $filepath = 'Files/'.$customer->id.'/'.'cdm_receipt'.'.'.$this->cdm_file->extension(); 
            
            Storage::disk('local')->putFileAs('public/Files/'.$customer->id. '/share//'.$share->id.'/', $this->cdm_file, 'cdm_receipt'.'.'.$this->cdm_file->extension());

            $share->files()->create([
                'filename' => 'cdm_receipt',
                'filedesc' => 'CDM Payment Receipt',
                'filetype' => $this->cdm_file->extension(),
                'filepath' => $filepath,
            ]);

            session()->flash('message', 'Share Application Successfully Send');
            session()->flash('success');
            session()->flash('title');

            return redirect()->route('home');            
        }
        else {
            // dd('Cheque);
            session()->flash('message', 'Share Application Successfully Send');
            session()->flash('success');
            session()->flash('title');
    
            return redirect()->route('home');              
        }   
    }

    public function restricApply($id)
    {
        $share = Share::where([['cust_id', $id ], ['flag', 1], ['step', 1], ['direction', 'buy']])->first();

        if ($share != null) {
            session()->flash('message', 'Add share application is been processed. If you want to make another application, please wait until the application is processed');
            session()->flash('info');
            session()->flash('title');
    
            return redirect()->route('home');                                
        }
    }

    public function contApply($cust_id)
    {
        $share = Share::where('cust_id', $cust_id)->firstOrCreate([
            'coop_id'     => $this->cust->coop_id, 
            'cust_id'     => $this->cust->id, 
        ], [
            'amt_before'  => $this->cust->share,
            'flag'        => 0, 
            'step'        => 0,
            'apply_amt'   => '0.00',        
        ]);

        $this->share_apply = $share->apply_amt;
        $this->online_date = $share?->online_date?->format('Y-m-d');
        $this->cdm_date = $share?->cdm_date?->format('Y-m-d');
        $this->cheque_no = $share?->cheque_no;
        $this->cheque_date = $share?->cheque_date?->format('Y-m-d');
    }

    public function mount()
    {
        $user = auth()->user();
        $this->cust = Customer::where('icno', $user->icno)->first();
        $this->banks = RefBank::where('coop_id', $user->coop_id)->get();

        $this->restricApply($this->cust->id);
        $this->contApply($this->cust->id);
    }

    public function render()
    {
        return view('livewire.page.application.apply-share.apply-share')->extends('layouts.head');
    }
}
