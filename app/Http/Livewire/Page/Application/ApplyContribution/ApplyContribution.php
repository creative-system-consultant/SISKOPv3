<?php

namespace App\Http\Livewire\Page\Application\ApplyContribution;

use App\Models\Contribution;
use App\Models\Customer;
use App\Models\FmsGlobalParm;
use App\Models\Ref\RefBank;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class ApplyContribution extends Component
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
    public $cheque_file;
    public $cheque_no;
    public $cheque_date;
    public $banks;
    public $total_contribution, $monthly_contribution;
    public $User;
    public $client_bank_id;
    public $client_bank_name;
    public $client_bank_acct;
    public $globalParm;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];

    protected $rules = [
        'cust.name'                 => 'required',
        'cust.identity_no'          => 'required',
        'cont_type'                 => 'required',
        'start_contDate'            => 'exclude_if:cont_type,==,pay_once,&&,cont_type,null|required_if:cont_type,==,cont_date' .
            '|before:first day of january next year|after_or_equal:today',
        'payment_method'            => 'required_if:cont_type,==,pay_once',
        'online_date'               => 'exclude_if:payment_method,==,cash,&&,payment_method,==,cheque,&&,cont_type,null,&&,cont_type,==,cont_date|' .
            'required_if:payment_method,==,online|before:first day of january next year|after_or_equal:today',
        'online_file'               => 'required_if:payment_method,==,online',
        'cdm_date'                  => 'exclude_if:payment_method,==,online,&&,payment_method,==,cheque,&&,cont_type,null,&&,cont_type,==,cont_date|' .
            'required_if:payment_method,==,cash|before:first day of january next year|after_or_equal:today',
        'cdm_file'                  => 'required_if:payment_method,==,cash',
        'cheque_date'               => 'exclude_if:payment_method,==,online,&&,payment_method,==,cash,&&,cont_type,null,&&,cont_type,==,cont_date|' .
            'required_if:payment_method,==,cheque|before:first day of january next year|after_or_equal:today',
        'banks'                     => 'required',
    ];

    protected $messages = [
        'start_contDate.required_if'    => ':attribute is required',
        'start_contDate.before'         => 'Please enter date in this year',
        'start_contDate.after_or_equal' => 'Please enter latest date',
        'cont_type.required'            => ':attribute field is required',
        'payment_method.required_if'    => ':attribute is required',
        'online_date.required_if'       => ':attribute field is required',
        'online_date.before'            => 'Please enter date in this year',
        'online_date.after_or_equal'    => 'Please enter latest date',
        'online_file.required_if'       => ':attribute field is required',
        'cdm_date.required_if'          => ':attribute field is required',
        'cdm_date.before'               => 'Please enter date in this year',
        'cdm_date.after_or_equal'       => 'Please enter latest date',
        'cdm_file.required_if'          => ':attribute field is required',
        'cheque_no.required_if'         => ':attribute field is required',
        'cheque_date.required_if'       => ':attribute field is required',
        'cheque_date.before'            => 'Please enter date in this year',
        'cheque_date.after_or_equal'    => 'Please enter latest date',
        'banks.required'                => ':attribute field is required',
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
        'banks'           => 'Bank',
    ];

    public function alertConfirm()
    {
        $this->validate();
        $this->validate($this->getContributionRules());

        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',
            'text'      => 'Are you sure you want to apply for add contribution?',
        ]);
    }

    public function getContributionRules()
    {
        $rules = [
            'cont_apply' => [
                'required',
                'numeric',
                'not_in:0',
            ],

        ];


        $globalParm = FmsGlobalParm::where('client_id', $this->User->client_id)->first();

        if ($globalParm) {
            $rules['cont_apply'][] = 'min:' . $globalParm->MIN_CONTRIBUTION;
        }
        if ($this->payment_method == 'cheque') {
            $rules['cheque_no'][] = ['required', 'numeric'];
        }

        return $rules;
    }

    public function submit()
    {
        $customer = Customer::where('identity_no', $this->User->icno)->where('client_id', $this->User->client_id)->first();
        $contribution = Contribution::where([['cust_id', $customer->id], ['flag', 0], ['step', 0], ['direction', 'buy']])->first();

        $this->validate($this->getContributionRules());

        $contribution->update([
            'direction'      => 'buy',
            'amt_before'     => $this->total_contribution ??= '0',
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
        $contribution->remove_approvals();
        $contribution->make_approvals('Contribution');

        if ($this->cont_type = 'pay_once') {
            if ($this->payment_method == 'online') {
                $filepath = 'Files/' . $customer->id . '/contribution//' . $contribution->id . '/' . 'online-CDM_receipt' . '.' . $this->online_file->extension();

                Storage::disk('local')->putFileAs('public/Files/' . $customer->id . '/contribution//' . $contribution->id . '/', $this->online_file, 'online-CDM_receipt' . '.' . $this->online_file->extension());

                $contribution->files()->create([
                    'filename' => 'online-CDM_receipt',
                    'filedesc' => 'Online/CDM Payment Receipt',
                    'filetype' => $this->online_file->extension(),
                    'filepath' => $filepath,
                ]);

                session()->flash('message', 'Add Contribution Application Successfully Send');
                session()->flash('time', 10000);
                session()->flash('success');
                session()->flash('title');

                return redirect()->route('home');
            } else {
                $filepath = 'Files/' . $customer->id . '/contribution//' . $contribution->id . '/' . 'cheque' . '.' . $this->cheque_file->extension();

                Storage::disk('local')->putFileAs('public/Files/' . $customer->id . '/contribution//' . $contribution->id . '/', $this->cheque_file, 'cheque' . '.' . $this->cheque_file->extension());

                $contribution->files()->create([
                    'filename' => 'cheque',
                    'filedesc' => 'Cheque Receipt',
                    'filetype' => $this->cheque_file->extension(),
                    'filepath' => $filepath,
                ]);

                session()->flash('message', 'Add Contribution Application Successfully Send');
                session()->flash('time', 10000);
                session()->flash('success');
                session()->flash('title');

                return redirect()->route('home');
            }
        }
    }

    public function restrictApply($id)
    {
        $contribution = Contribution::where([['cust_id', $id], ['flag', 1], ['step', 1], ['direction', 'buy']])->first();

        if ($contribution != null) {
            session()->flash('message', 'Add contribution application is been processed. If you want to make another application, please wait until the application is processed');
            session()->flash('time', 10000);
            session()->flash('info');
            session()->flash('title');

            return redirect()->route('home');
        }
    }

    public function mount()
    {
        $this->User = auth()->user();
        $this->cust = Customer::where('identity_no', $this->User->icno)->where('client_id', $this->User->client_id)->first();
        $this->banks = RefBank::where('client_id', $this->User->client_id)->get();
        $this->restrictApply($this->cust->id);

        $this->total_contribution = $this->cust->fmsMembership->total_contribution;
        $this->monthly_contribution = $this->cust->fmsMembership->monthly_contribution;

        $contribution = Contribution::where('cust_id', $this->cust->id)
            ->where('flag', '<', 1)
            ->where('step', '<', 1)
            ->where('direction', 'buy')
            ->first();


        if ($contribution) {
            $this->cont_apply       = $contribution->apply_amt;
            $this->online_date      = $contribution?->online_date?->format('Y-m-d');
            $this->cdm_date         = $contribution?->cdm_date?->format('Y-m-d');
            $this->cheque_date      = $contribution?->cheque_date?->format('Y-m-d');
            $this->cheque_no        = $contribution?->cheque_no;
            $this->cheque_date      = $contribution?->cheque_date?->format('Y-m-d');
            $this->start_contDate   = $contribution?->start_apply?->format('Y-m-d');
        } else {

            $contribution = Contribution::create([
                'client_id'   => $this->cust->client_id,
                'cust_id'     => $this->cust->id,
                'direction'   => 'buy',
                'amt_before'  => $this->cust->fmsMembership->total_contribution,
                'flag'        => 0,
                'step'        => 0,
                'apply_amt'   => '0.00',
            ]);
        }
        $this->globalParm = FmsGlobalParm::where('client_id', $this->User->client_id)->first();

        $this->client_bank_id = $this->globalParm->DEF_CLIENT_BANK_ID;
        $bank_name = RefBank::select('description')->where('id', $this->client_bank_id)->first();
        $this->client_bank_name = $bank_name->description;
        $this->client_bank_acct = $this->globalParm->DEF_CLIENT_BANK_ACCT_NO;
    }

    public function render()
    {
        return view('livewire.page.application.apply-contribution.apply-contribution')->extends('layouts.head');
    }
}
