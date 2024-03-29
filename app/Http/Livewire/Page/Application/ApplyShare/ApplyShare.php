<?php

namespace App\Http\Livewire\Page\Application\ApplyShare;

use App\Models\Customer;
use App\Models\FmsGlobalParm;
use App\Models\Ref\RefBank;
use App\Models\Share;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class ApplyShare extends Component
{
    use WithFileUploads;

    public Customer $cust;
    public Share $Share;
    public $share_apply;
    public $pay_method;
    public $online_date;
    public $online_file;
    public $cdm_date;
    public $cdm_file;
    public $cheque_no;
    public $cheque_date;
    public $cheque_file;
    public $total_share;
    public $globalParm;
    public $User;
    public $client_bank_id;
    public $client_bank_name;
    public $client_bank_acct;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];

    protected $rules = [
        'cust.name'       => 'required',
        'cust.identity_no' => 'required',
        'pay_method'      => 'required',
        'online_date'     => 'exclude_if:pay_method,==,cash,&&,pay_method,==,cheque,&&,cont_type,null,&&,cont_type,==,cont_date|' .
            'required_if:pay_method,==,online|before:first day of january next year|after_or_equal:today',
        'online_file'     => 'required_if:pay_method,==,online',
        'cdm_date'        => 'exclude_if:pay_method,==,online,&&,pay_method,==,cheque,&&,cont_type,null,&&,cont_type,==,cont_date|' .
            'required_if:pay_method,==,cash|before:first day of january next year|after_or_equal:today',
        'cdm_file'        => 'required_if:pay_method,==,cash',
        'cheque_no'       => 'required_if:pay_method,==,cheque',
        'cheque_date'     => 'exclude_if:pay_method,==,online,&&,pay_method,==,cash,&&,cont_type,null,&&,cont_type,==,cont_date|' .
            'required_if:pay_method,==,cheque|before:first day of january next year|after_or_equal:today',
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

    public function alertConfirm()
    {
        $this->validate();

        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',
            'text'      => 'Are you sure you want to apply for add share?',
        ]);
    }


    public function getShareRules()
    {
        $rules = [
            'share_apply' => [
                'required',
                'numeric',
            ],
        ];

        $globalParm = FmsGlobalParm::where('client_id', $this->User->client_id)->first();
        if ($globalParm) {
            $rules['share_apply'][] = 'min:' . $globalParm->MIN_SHARE; // Use the dynamic minimum value from $globalParm->MIN_SHARE
        }

        return $rules;
    }



    public function submit()
    {
        $customer = Customer::where('identity_no', $this->User->icno)->where('client_id', $this->User->client_id)->first();
        $this->validate($this->getShareRules());

        if ($this->share_apply == 0) {
            session()->flash('message', 'Application must be more than RM0');
            session()->flash('time', 10000);
            session()->flash('warning');
            session()->flash('title');

            return redirect()->route('share.apply');
        }

        $this->Share->update([
            'method'       => $this->pay_method,
            'online_date'  => $this->online_date ??= NULL,
            'cdm_date'     => $this->cdm_date ??= NULL,
            'cheque_date'  => $this->cheque_date ??= NULL,
            'cheque_no'    => $this->cheque_no ??= NULL,
            'apply_amt'    => $this->share_apply,
            'apply_date'   => now(),
            'approved_amt' => NULL,
            'flag'         => 1,
            'step'         => 1,
            'created_by'   => strtoupper($customer->name),
        ]);
        $this->Share->remove_approvals();
        $this->Share->make_approvals('Share');

        if ($this->pay_method == 'online') {
            $filepath = 'Files/' . $customer->id . '/share//' . $this->Share->id . '/' . 'online-CDM_receipt' . '.' . $this->online_file->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customer->id . '/share//' . $this->Share->id . '/', $this->online_file, 'online-CDM_receipt' . '.' . $this->online_file->extension());

            $this->Share->files()->create([
                'filename' => 'online-CDM_receipt',
                'filedesc' => 'Online/CDM Payment Receipt',
                'filetype' => $this->online_file->extension(),
                'filepath' => $filepath,
            ]);
        } else {
            $filepath = 'Files/' . $customer->id . '/share//' . $this->Share->id . '/' . 'cheque' . '.' . $this->cheque_file->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customer->id . '/share//' . $this->Share->id . '/', $this->cheque_file, 'cheque' . '.' . $this->cheque_file->extension());

            $this->Share->files()->create([
                'filename' => 'cheque',
                'filedesc' => 'Cheque Receipt',
                'filetype' => $this->cheque_file->extension(),
                'filepath' => $filepath,
            ]);
        }

        session()->flash('message', 'Share Application Successfully Send');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }

    public function mount()
    {
        $this->User = auth()->user();
        $this->cust = Customer::where('identity_no', $this->User->icno)->where('client_id', $this->User->client_id)->first();
        $this->total_share = $this->cust->fmsMembership->total_share;

        $share = Share::where([
            ['cust_id', $this->cust->id],
            ['flag', 1]
        ])->first();


        if ($share != NULL) {
            session()->flash('message', 'Add Share application has been processed. You can only apply once at a time.');
            session()->flash('time', 10000);
            session()->flash('info');
            session()->flash('title');

            return redirect()->route('home');
        } else {
            $this->Share = Share::create([
                'cust_id'   => $this->cust->id,
                'client_id' => $this->cust->client_id,
                'flag'      => 0,
                'step'      => 0,
                'direction' => 'buy',
                'amt_before'  => $this->cust->fmsMembership->total_share,
                'apply_amt'   => '0.00',
            ]);

            $this->share_apply = $this->Share->apply_amt;
            $this->online_date = $this->Share?->online_date?->format('Y-m-d');
            $this->cdm_date = $this->Share?->cdm_date?->format('Y-m-d');
            $this->cheque_no = $this->Share?->cheque_no;
            $this->cheque_date = $this->Share?->cheque_date?->format('Y-m-d');
        }
    }

    public function deb()
    {
        dd([
            'Share' => $this->Share,
        ]);
    }

    public function render()
    {
        $this->globalParm = FmsGlobalParm::where('client_id', $this->User->client_id)->first();

        $this->client_bank_id = $this->globalParm->DEF_CLIENT_BANK_ID;
        $bank_name = RefBank::select('description')->where('id', $this->client_bank_id)->first();
        $this->client_bank_name = $bank_name->description;
        $this->client_bank_acct = $this->globalParm->DEF_CLIENT_BANK_ACCT_NO;
        return view('livewire.page.application.apply-share.apply-share')->extends('layouts.head');
    }
}
