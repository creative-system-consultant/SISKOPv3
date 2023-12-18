<?php

namespace App\Http\Livewire\Page\Application\ApplyChangeGuarantor;

use App\Models\AccountPosition;
use App\Models\ChangeGuarantor;
use App\Models\Customer;
use App\Models\GuarantorList;
use App\Models\SiskopCustomer;
use Livewire\Component;

class Index extends Component
{
    public $user, $client_id, $siskop_cust, $fms_cust, $acct_master, $acct_position, $guarantor, $clicked = 0, $result, $search, $acct_no, $reasonChange, $reasonChangeTxt;
    public $name, $mbr_no, $mbr_no_old, $identity_no_old, $name_old;

    public function mount()
    {
        $this->user = auth()->user();
        $this->client_id = $this->user->client_id;

        $this->siskop_cust      = SiskopCustomer::where('identity_no', $this->user->icno)->where('client_id', $this->client_id)->first();


        $changeGuarantor = ChangeGuarantor::where([
            ['cust_id', $this->siskop_cust->id],
            ['flag', '<>', 3]
        ])->first();


        if ($changeGuarantor != NULL) {
            if ($this->anggota->flag == '0') {
                session()->flash('message', 'Close Membership application has been processed. You only need to apply once.');
                session()->flash('time', 10000);
                session()->flash('info');
                session()->flash('title');
            }
            return redirect()->route('home');
        }

        // $this->acct_position    = $this->acct_master->position;
        // dump($this->acct_position);
    }

    public function searchGuarantor($acct_no)
    {
        $this->clicked = 1;
        $this->guarantor = GuarantorList::where('account_no', $acct_no)->where('client_id', $this->client_id)->first();
        $this->acct_no = $acct_no;
        $this->mbr_no_old = $this->guarantor->fmsMembership->mbr_no;
        $this->identity_no_old = $this->guarantor->fmsMembership->fmsCustomer->identity_no;
        $this->name_old = $this->guarantor->fmsMembership->fmsCustomer->name;
    }

    public function searchUser()
    {
        $this->guarantor = GuarantorList::where('account_no', $this->acct_no)->where('client_id', $this->client_id)->first();

        if (strlen($this->search) == 12) {
            $result = Customer::with('fmsMembership')->where('identity_no', $this->search)->whereHas('fmsMembership', function ($query) {
                $query->where('client_id', $this->client_id);
            })->first();


            if ($result == NULL) {
                $this->addError('search', 'No User with this IC');
                $this->mbr_no = "";
                $this->name = "";
            } else {
                $this->result = $result;
                $this->mbr_no = $result->fmsMembership->mbr_no;
                $this->name = $result->name;
                $this->resetErrorBag('search');
            }
        } else {
            $this->mbr_no = "";
            $this->name = "";
        }
        // }
    }

    public function submit()
    {
        $close_membership = ChangeGuarantor::create([
            'cust_id'           => $this->siskop_cust->id,
            'account_no'        => $this->acct_no,
            'old_jamin_member1'              => $this->mbr_no_old,
            'old_jamin_name1'              => $this->name_old,
            'old_jamin_icno1'              => $this->identity_no_old,
            'new_jamin_member1'              => $this->mbr_no,
            'new_jamin_name1'              => $this->name,
            'new_jamin_icno1'              => $this->result->identity_no,
            'jamin_reason'              => $this->reasonChange,
            'jamin_reason_txt'              => $this->reasonChangeTxt,
            'flag'              => '0',
            'step'              => '0',
            'created_by'        => auth()->user()->name,
            'created_at'        => now()
        ]);

        session()->flash('message', 'Close Membership Application Successfully Applied');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect('home');
    }

    public function render()
    {
        $this->fms_cust         = Customer::where([['client_id', $this->client_id], ['identity_no', $this->user->icno]])->firstOrFail();

        $membership             = $this->fms_cust->fmsMembership;

        $this->acct_master      = $membership->fmsAcctMaster;
        $this->acct_position   = [];

        foreach ($this->acct_master as $item) {
            $account_info = $item->account_no;
            $acct_position = AccountPosition::where('account_no', $account_info)
                ->where('client_id', $this->client_id)
                // ->where('bal_outstanding', '>', 0)
                ->first();
            if ($acct_position->bal_outstanding > 0)
                $this->acct_position[] = $acct_position;
        }
        // dd($this->acct_position);

        if ($this->clicked == 1) {
            $this->guarantor = GuarantorList::where('account_no', $this->acct_no)->where('client_id', $this->client_id)->first();
        }
        return view('livewire.page.application.apply-change-guarantor.index')->extends('layouts.head');
    }
}
