<?php

namespace App\Http\Livewire\Page\Application\Dividend;

use App\Models\Applydividend as ModelApplydividend;
use App\Models\Customer;
use App\Models\Dividend;
use App\Models\User;
use Livewire\Component;

class ApplyDividend extends Component
{
    public User $User;
    public Customer $Cust;
    public ModelApplydividend $apply;
    public $Dividend;

    public $payout_cash   = false;
    public $payout_share  = false;
    public $payout_contri = false;
    public $cash_amt;
    public $share_amt;
    public $contri_amt;
    public $payout;
    public $cur_bal_dividend;
    public $pending_div = 0;
    public $total_amt_dividen;
    public $max_bal_dividend;

    protected $rules = [
        'Dividend.bal_dividen'  => '',

        'payout_cash'       => '',
        'payout_share'      => '',
        'payout_contri'     => '',

        'apply.div_cash_apply'   => 'required|numeric',
        'apply.div_share_apply'  => 'required|numeric',
        'apply.div_contri_apply' => 'required|numeric',

    ];

    public function getPayoutRules()
    {
        $rules = [
            'payout' => [
                'required',
                'numeric',
                'min:1',
            ]
        ];

        $rules['payout'][] = 'max:' . $this->max_bal_dividend;

        return $rules;
    }

    protected $messages = [
        //'payout.*'    => 'Total Payout must be more than 0 and less than Dividend',
    ];

    public function updatePayout()
    {
        $cash = $this->payout_cash ? $this->apply->div_cash_apply : '0';
        $share = $this->payout_share ? $this->apply->div_share_apply : '0';
        $contri = $this->payout_contri ? $this->apply->div_contri_apply : '0';

        if (is_numeric($cash) && is_numeric($share) && is_numeric($contri)) {
            $payout = $cash + $share + $contri;
            $this->payout = round($payout, 2);
            $this->apply->div_cash_apply = $cash;
            $this->apply->div_share_apply = $share;
            $this->apply->div_contri_apply = $contri;
        }
    }



    public function submit()
    {
        $this->validate();
        $this->validate($this->getPayoutRules());

        $this->apply->dividend_total = $this->Dividend->bal_dividen;
        $this->apply->share_before  = $this->Cust->fmsMembership->total_share;
        $this->apply->contri_before = $this->Cust->fmsMembership->total_contribution;
        $this->apply->flag = 1;
        $this->apply->apply_date = now();
        $this->apply->save();

        $this->apply->make_approvals();

        session()->flash('message', 'Dividend Payout Application has been sent');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('home');
    }


    public function mount()
    {
        $this->cur_bal_dividend = 0;
        $this->User = User::find(auth()->user()->id);
        $this->Cust = Customer::where([['client_id', $this->User->client_id], ['identity_no', $this->User->icno]])->firstOrFail();

        $this->Dividend = Dividend::where([['client_id', $this->User->client_id], ['identity_no', $this->User->icno]])->first();
        if ($this->Dividend == NULL) {
            session()->flash('message', 'There are no Dividend Payout for this Customer');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('home');
        } else if ($this->Dividend) {
            if ($this->Dividend->bal_div_withdrawal == NULL) {
                $this->cur_bal_dividend = round($this->Dividend->bal_dividen - $this->Dividend->bal_div_pending_withdrawal, 2);
                $this->max_bal_dividend = $this->cur_bal_dividend;
                $this->total_amt_dividen = $this->Dividend->total_amt_dividen;
            } else {
                $this->cur_bal_dividend = round($this->Dividend->bal_dividen - $this->Dividend->bal_div_pending_withdrawal, 2);
                $this->pending_div = $this->Dividend->bal_div_pending_withdrawal;
                $this->max_bal_dividend = $this->cur_bal_dividend;
                $this->total_amt_dividen = $this->Dividend->total_amt_dividen;
            }
        }

        $apply = ModelApplydividend::where([
            ['cust_id', $this->Cust->id],
            ['client_id', $this->User->client_id],
            ['div_year', date('Y')],
        ])->orderBy('id', 'desc')->first();

        if ($apply->flag >= 20) {
            $this->apply = new ModelApplydividend;
            $this->apply->client_id   = $this->User->client_id;
            $this->apply->cust_id   = $this->Cust->id;
            $this->apply->mbr_no    = $this->Cust->fmsMembership->mbr_no;
            $this->apply->flag  = 0;
            $this->apply->step  = 0;
            $this->apply->div_year  = date('Y');
            $this->apply->save();
        } else if ($apply->flag == 1) {
            session()->flash('message', 'Only 1 active application allowed. Please Wait until previous application is authorized.');
            session()->flash('warning');
            session()->flash('title', 'Success!');

            return redirect()->route('home');
        } else {
            $this->apply = $apply;
        }
    }

    public function render()
    {
        if (is_numeric($this->apply->div_cash_apply) && is_numeric($this->apply->div_share_apply) && is_numeric($this->apply->div_contri_apply)) {
            $this->cur_bal_dividend = number_format(($this->Dividend->bal_dividen - $this->pending_div) - ($this->apply->div_cash_apply + $this->apply->div_share_apply + $this->apply->div_contri_apply), 2);
        }
        return view('livewire.page.application.dividend.apply-dividend')->extends('layouts.head');
    }
}
