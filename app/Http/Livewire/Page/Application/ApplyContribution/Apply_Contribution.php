<?php

namespace App\Http\Livewire\Page\Application\ApplyContribution;

use App\Models\contribution;
use App\Models\Customer;
use App\Models\Ref\RefBank;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Apply_Contribution extends Component
{
    use WithFileUploads;

    public Customer $cust;
    public $cont_apply;
    public $cont_type;
    public $start_contDate;
    public $payment_method;
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
        'cust.name'                 => 'required',
        'cust.icno'                 => 'required',
        'cust.contribution'         => 'required',
        'cust.contribution_monthly' => 'required',
        'cont_apply'                => 'required|numeric',
        'cont_type'                 => 'required',
        'start_contDate'            => 'required_if:cont_type,==,cont_date',
        'payment_method'            => 'required_if:cont_type,==,pay_once',
        'online_date'               => 'required_if:payment_method,==,online',
        'online_file'               => 'required_if:payment_method,==,online',
        'cdm_date'                  => 'required_if:payment_method,==,cash',
        'cdm_file'                  => 'required_if:payment_method,==,cash',
        'cheque_no'                 => 'required_if:payment_method,==,cheque',
        'cheque_date'               => 'required_if:payment_method,==,cheque',
        
    ];

    protected $messages = [
        'cont_apply.required'         => ':attribute field is required',
        'cont_apply.numeric'          => ':attribute field must be number',
        'cont_type.required'          => ':attribute field is required',
        'start_contDate.required_if'  => ':attribute field is required',
        'payment_method.required_if'  => ':attribute is required',
        'online_date.required_if'     => ':attribute field is required',
        'online_file.required_if'     => ':attribute field is required',
        'cdm_date.required_if'        => ':attribute field is required',
        'cdm_file.required_if'        => ':attribute field is required',
        'cheque_no.required_if'       => ':attribute field is required',
        'cheque_date.required_if'     => ':attribute field is required',
    ];

    protected $validationAttributes = [
        'cont_apply'      => 'Add Contribution Applied',
        'cont_type'       => 'Types of Add Contribution',
        'start_contDate'  => 'Start Date',
        'payment_method'  => 'Payment Method',
        'online_date'     => 'Online Payment Date',
        'online_file'     => 'Upload Online Payment Receipt',
        'cdm_date'        => 'Cdm Payment Date',
        'cdm_file'        => 'Upload Cdm Payment Receipt',
        'cheque_no'       => 'Cheque No.',
        'cheque_date'     => 'Cheque Date',
    ];

    public function alertConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',  
            'text'      => 'Are you sure you want to apply for add contribution?',
        ]);   
    }

    public function submit()
    {
        if ($this->cont_apply == 0) {
            session()->flash('message', 'Application must be more than RM0');
            session()->flash('warning');
            session()->flash('title');

            return redirect()->route('contribution.apply');
        }
    
        $user = auth()->user();
        $customer = Customer::where('icno', $user->icno)->first();
        $contribution = contribution::where([['cust_id', $customer->id], ['flag', 0], ['step', 0], ['direction', 'buy']])->first();

        $this->validate();

        $contribution->update([
            'direction'      => 'buy',
            'amt_before'     => $this->cust['contribution'] ??= '0',
            'apply_amt'      => $this->cont_apply,
            'approved_amt'   => NULL,
            'start_apply'    => $this->start_contDate ??= NULL,
            'start_approved' => NULL,
            'method'         => $this->payment_method ?? 'online',
            'online_date'    => $this->online_date ??= NULL,
            'cdm_date'       => $this->cdm_date ??= NULL,
            'cheque_date'    => $this->cheque_date ??= NULL,
            'cheque_no'      => $this->cheque_no ??= NULL,
            'flag'           => 1,
            'step'           => 1,
            'created_by'     => strtoupper($customer->name),  
        ]);
    
        if ($this->payment_method == 'online') {
            // dd('Online Banking');
            $files = $this->online_file->getClientOriginalName();
            $filename = pathinfo($files, PATHINFO_FILENAME);
            $filepath = 'Files/'.$customer->id.'/'.$filename.'.'.$this->online_file->extension();     

            Storage::disk('local')->putFileAs('public/Files/' . $customer->id. '/', $this->online_file, $filename.'.'.$this->online_file->extension());

            $contribution->files()->create([
                'filename' => $filename,
                'filedesc' => 'Online Payment Receipt',
                'filetype' => $this->online_file->extension(),
                'filepath' => $filepath,
            ]);

            session()->flash('message', 'Add Contribution Application Successfully Send');
            session()->flash('success');
            session()->flash('title');

            return redirect()->route('home');
        }
        elseif ($this->payment_method == 'cash') {
            // dd('CDM');
            $files = $this->cdm_file->getClientOriginalName();
            $filename = pathinfo($files, PATHINFO_FILENAME);
            $filepath = 'Files/'.$customer->id.'/'.$filename.'.'.$this->cdm_file->extension(); 
            
            Storage::disk('local')->putFileAs('public/Files/' . $customer->id. '/', $this->cdm_file, $filename.'.'.$this->cdm_file->extension());

            $contribution->files()->create([
                'filename' => $filename,
                'filedesc' => 'CDM Payment Receipt',
                'filetype' => $this->cdm_file->extension(),
                'filepath' => $filepath,
            ]);

            session()->flash('message', 'Add Contribution Application Successfully Send');
            session()->flash('success');
            session()->flash('title');

            return redirect()->route('home');            
        }
        else {
            // dd('Cheque');
            session()->flash('message', 'Add Contribution Application Successfully Send');
            session()->flash('success');
            session()->flash('title');
    
            return redirect()->route('home');              
        }    
    }
    

    public function restrictApply($id)
    {
        $contribution = contribution::where([['cust_id', $id ], ['flag', 1], ['step', 1], ['direction', 'buy']])->first();

        if ($contribution != null) {
            session()->flash('message', 'Add contribution application is been processed. If you want to make another application, please wait until the application is processed');
            session()->flash('info');
            session()->flash('title');
    
            return redirect()->route('home');                                
        }
    }

    public function contApply($id)
    {
        $contribution = contribution::where('cust_id', $id)->firstOrCreate([
            'coop_id'     => $this->cust->coop_id, 
            'cust_id'     => $this->cust->id, 
            'amt_before'  => $this->cust->contribution,
            'flag'        => 0, 
            'step'        => 0
        ], [
            'apply_amt'   => '0.00',        
        ]);

        $this->cont_apply       = $contribution->apply_amt;
        $this->online_date      = $contribution?->online_date?->format('Y-m-d');
        $this->cdm_date         = $contribution?->cdm_date?->format('Y-m-d');
        $this->cheque_date      = $contribution?->cheque_date?->format('Y-m-d');
        $this->cheque_no        = $contribution?->cheque_no;
        $this->cheque_date      = $contribution?->cheque_date?->format('Y-m-d');
        $this->start_contDate   = $contribution?->start_apply?->format('Y-m-d');        
    }
    
    public function mount()
    {
        $user = auth()->user();
        $this->cust = Customer::where('icno', $user->icno)->first();
        $this->banks = RefBank::where('coop_id', $user->coop_id)->get();

        $this->restrictApply($this->cust->id);
        $this->contApply($this->cust->id);
    }

    public function render()
    {
        return view('livewire.page.application.apply-contribution.apply-contribution')->extends('layouts.head');
    }
}
