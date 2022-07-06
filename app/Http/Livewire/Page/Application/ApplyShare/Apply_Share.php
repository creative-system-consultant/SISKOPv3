<?php

namespace App\Http\Livewire\Page\Application\ApplyShare;

use App\Models\Customer;
use App\Models\Ref\RefBank;
use App\Models\share;
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
    public $share;

    protected $rules = [
        'cust.name'       => 'required',
        'cust.icno'       => 'required',
        'cust.share'      => 'required',
        'share_apply'     => 'required|numeric',
        'pay_method'      => 'required',
        'online_date'     => 'required_if:payment_method,==,online',
        'online_file'     => 'required_if:payment_method,==,online',
        'cdm_date'        => 'required_if:payment_method,==,cash',
        'cdm_file'        => 'required_if:payment_method,==,cash',
        'cheque_no'       => 'required_if:payment_method,==,cheque',
        'cheque_date'     => 'required_if:payment_method,==,cheque',
    ];
    
    protected $messages = [
        'share_apply.required'        => ':attribute field is required',
        'payment_method.required'     => ':attribute field is required',
        'online_date.required_if'     => ':attribute field is required',
        'online_file.required_if'     => ':attribute field is required',
        'cdm_date.required_if'        => ':attribute field is required',
        'cdm_file.required_if'        => ':attribute field is required',
        'cheque_no.required_if'       => ':attribute field is required',
        'cheque_date.required_if'     => ':attribute field is required',
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
    ];

    public function submit()
    {
        $user = auth()->user();
        $customer = Customer::where('icno', $user->icno)->first();

        $this->validate();
        
        $share = share::create([
            'coop_id'      => $customer->coop_id,
            'cust_id'      => $customer->id,
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
            $files = $this->online_file->getClientOriginalName();
            $filename = pathinfo($files, PATHINFO_FILENAME);
            $filepath = 'Files/'.$customer->id.'/'.$filename.'.'.$this->online_file->extension();                    

            Storage::disk('local')->putFileAs('public/Files/' . $customer->id. '/', $this->online_file, $filename.'.'.$this->online_file->extension());

            $share->files()->create([
                'filename' => $filename,
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
            $files = $this->cdm_file->getClientOriginalName();
            $filename = pathinfo($files, PATHINFO_FILENAME);
            $filepath = 'Files/'.$customer->id.'/'.$filename.'.'.$this->cdm_file->extension(); 
            
            Storage::disk('local')->putFileAs('public/Files/' . $customer->id. '/', $this->cdm_file, $filename.'.'.$this->cdm_file->extension());

            $share->files()->create([
                'filename' => $filename,
                'filedesc' => 'Online Payment Receipt',
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
        $share = share::where([['cust_id', $id ], ['flag', 1], ['step', 1], ['direction', 'buy']])->first();

        if ($share != null) {
            session()->flash('message', 'Add share application is been processed. If you want to make another application, please wait until the application is processed');
            session()->flash('info');
            session()->flash('title');
    
            return redirect()->route('home');                                
        }
    }

    public function mount()
    {
        $user = auth()->user();
        $this->cust = Customer::where('icno', $user->icno)->first();
        $this->banks = RefBank::where('coop_id', $user->coop_id)->get();
        
        $this->share = share::where('cust_id', $this->cust->id)->firstOrCreate([
            'coop_id'     => $this->cust->coop_id, 
            'cust_id'     => $this->cust->id, 
            'amt_before'  => $this->cust->share,
            'apply_amt'   => '0.00',
            'flag'        => 0, 
            'step'        => 0
        ]);

        $this->share_apply = $this->share?->apply_amt;
        $this->online_date = $this->share?->online_date?->format('Y-m-d');
        $this->cdm_date = $this->share?->cdm_date?->format('Y-m-d');
        $this->cheque_no = $this->share?->cheque_no;
        $this->cheque_date = $this->share?->cheque_date?->format('Y-m-d');

        $this->restricApply($this->cust->id);
    }

    public function render()
    {
        return view('livewire.page.application.apply-share.apply-share')->extends('layouts.head');
    }
}
