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
    public Dividend $Dividend;
    public ModelApplydividend $apply;

    public $payout_cash   = false;
    public $payout_share  = false;
    public $payout_contri = false;
    public $cash_amt;
    public $share_amt;
    public $contri_amt;
    public $payout;

    protected $rules = [
        'Dividend.bal_div'  => '',
        'payout'            => 'lt:Dividend.bal_div|gt:0',

        'payout_cash'       => '',
        'payout_share'      => '',
        'payout_contri'     => '',

        'apply.div_cash_apply'   => '',
        'apply.div_share_apply'  => '',
        'apply.div_contri_apply' => '',
    ];

    protected $messages = [
        //'payout.*'    => 'Total Payout must be more than 0 and less than Dividend',
    ];

    public function updatePayout()
    {
        $cash = $this->payout_cash ? $this->apply->div_cash_apply : '0';
        $share = $this->payout_share ? $this->apply->div_share_apply : '0';
        $contri = $this->payout_contri ? $this->apply->div_contri_apply : '0';

        $this->payout = $cash + $share + $contri;
    }

    public function submit()
    {
        $this->validate();

        $this->apply->dividend_total = $this->Dividend->total_div;
        $this->apply->share_before  = $this->Cust->share;
        $this->apply->contri_before = $this->Cust->contribution;
        $this->apply->flag = 1;
        $this->apply->save();

        $this->apply->make_approvals();

        session()->flash('message', 'dividend Payout Application has been sent');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('home');
    }

    public function deb()
    {
        dd([
            'Cust'          => $this->Cust,
            'apply'         => $this->apply,
            'payout_cash'   => $this->payout_cash,
            'payout_share'  => $this->payout_share,
            'payout_contri' => $this->payout_contri,
            'cash_amt'      => $this->cash_amt,
            'share_amt'     => $this->share_amt,
            'contri_amt'    => $this->contri_amt,
            'cash'          => $this->payout_cash ? $this->apply->div_cash_apply : '0',
            'share'         => $this->payout_share ? $this->apply->div_share_apply : '0',
            'contri'        => $this->payout_contri ? $this->apply->div_contri_apply : '0',
            'Dividend'      => $this->Dividend,
        ]);
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
        $this->Cust = Customer::where([['coop_id', $this->User->coop_id],['icno', $this->User->icno]])->firstOrFail();

        $this->Dividend = Dividend::where([['coop_id', $this->User->coop_id],['cust_id', $this->Cust->id]])->first();
        if ($this->Dividend == NULL){
            session()->flash('message', 'There are no Dividend Payout for this Customer');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('home');
        } else if ($this->Dividend) {

        }
        $apply = ModelApplydividend::where([['coop_id', $this->User->coop_id],['cust_id', $this->Cust->id],['div_year', date('Y')]])->first();

        if ($apply == NULL){
            $this->apply = new ModelApplydividend;
            $this->apply->coop_id   = $this->User->coop_id;
            $this->apply->cust_id   = $this->Cust->id;
            $this->apply->mbr_no    = $this->Cust->ref_no;
            $this->apply->div_year  = date('Y');
            $this->apply->save();
        } else if ($apply->flag == 0) {
            $this->apply = $apply;
        } else {
            session()->flash('message', 'Only 1 active application allowed. Please Wait until previous application is authorized.');
            session()->flash('warning');
            session()->flash('title', 'Success!');

            return redirect()->route('home');
        }
    }

    public function render()
    {
        return view('livewire.page.application.dividend.apply-dividend')->extends('layouts.head');
    }
}
