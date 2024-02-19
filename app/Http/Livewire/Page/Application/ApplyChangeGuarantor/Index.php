<?php

namespace App\Http\Livewire\Page\Application\ApplyChangeGuarantor;

use App\Models\AccountPosition;
use App\Models\ChangeGuarantor;
use App\Models\ChangeGuarantorDetails;
use App\Models\Customer;
use App\Models\FmsMembership;
use App\Models\GuarantorList;
use App\Models\SiskopCustomer;
use Livewire\Component;

class Index extends Component
{
    public $user, $client_id, $siskop_cust, $fms_cust, $acct_master, $acct_position, $guarantor, $clicked = 0, $result, $search, $acct_no, $reasonChange, $reasonChangeTxt;
    public $name, $mbr_no, $mbr_no_old, $identity_no_old, $name_old;
    public $guarantors = [];
    public $searchNRIC = [];
    public $mbrNos = [];
    public $names = [];
    public $newNric = [];
    public $oldName = [];
    public $oldNric = [];
    public $oldMbrno = [];

    protected $listeners = ['submit'];

    public function mount()
    {
        $this->user = auth()->user();
        $this->client_id = $this->user->client_id;

        $fms_cust = Customer::where([['client_id', $this->client_id], ['identity_no', $this->user->icno]])->firstOrFail();


        $changeGuarantor = ChangeGuarantor::where([
            ['cif_id', $fms_cust->id],
            ['flag', 0],
            ['step', 0]
        ])->first();

        if ($changeGuarantor != NULL) {
            if ($changeGuarantor->flag > '0') {
                session()->flash('message', 'Change guarantor application has been processed. You only need to apply once.');
                session()->flash('time', 10000);
                session()->flash('info');
                session()->flash('title');
                return redirect()->route('home');
            }
        }
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


    public function searchUser($index)
    {
        if (!isset($this->searchNRIC[$index])) {
            return;
        }

        $searchTerm = $this->searchNRIC[$index];

        if (strlen($searchTerm) == 12) {
            $result = Customer::with(['fmsMembership', 'fmsMembership.refMemStat'])
                ->where('identity_no', $searchTerm)
                ->whereHas('fmsMembership', function ($query) {
                    $query->where('client_id', $this->client_id);
                })->first();

            if ($result === null) {
                $this->addError('searchNRIC.' . $index, 'No User with this IC');
                $this->mbrNos[$index] = '';
                $this->names[$index] = '';
                $this->newNric[$index] = '';
            } else if ($result->fmsMembership->refMemStat->allow_guarantor_flag == "N") {
                $this->addError('searchNRIC.' . $index, 'This user is unable to be a guarantor');
            } else {
                $this->mbrNos[$index] = $result->fmsMembership->mbr_no ?? '';
                $this->names[$index] = $result->name ?? '';
                $this->newNric[$index] = $result->identity_no ?? '';
                $this->resetErrorBag('searchNRIC.' . $index);
            }
        } else {
            $this->mbrNos[$index] = '';
            $this->names[$index] = '';
        }
    }

    public function submit()
    {

        if ($this->guarantor) {
            $applyChangeGuarantor = ChangeGuarantor::create([
                'client_id' => $this->client_id,
                'cif_id' => $this->fms_cust->id,
                'apply_date'   => now(),
                'account_no' => $this->acct_no,
                'jamin_reason' => $this->reasonChange,
                'jamin_reason_txt' => $this->reasonChangeTxt,
                'flag' => '1',
                'step' => '1',
                'created_by' => auth()->user()->name,
                'created_at' => now()
            ]);

            foreach ($this->guarantor as $index => $guarantor) {
                $mbr_no = $this->mbrNos[$index] ?? null;
                $name = $this->names[$index] ?? null;
                $identity_no = $this->newNric[$index] ?? null;
                $old_guarantor = FmsMembership::where('mbr_no', $guarantor->guarantor_mbr_id)->first();
                $old_guarantor_customer = $old_guarantor->fmsCustomer;
                $old_guarantor_mbrNo = $old_guarantor->mbr_no;
                $old_guarantor_name = $old_guarantor_customer->name;
                $old_guarantor_nric = $old_guarantor_customer->identity_no;


                $ChangeGuarantorDetails = ChangeGuarantorDetails::create([
                    'client_id' => $this->client_id,
                    'apply_id' => $applyChangeGuarantor->id,
                    'cif_id' => $this->fms_cust->id,
                    'account_no' => $guarantor->account_no,
                    'old_jamin_member' => $old_guarantor_mbrNo,
                    'old_jamin_name' => $old_guarantor_name,
                    'old_jamin_icno' => $old_guarantor_nric,
                    'new_jamin_member' => $mbr_no,
                    'new_jamin_name' => $name,
                    'new_jamin_icno' => $identity_no,
                    'created_by' => auth()->user()->name,
                    'created_at' => now()
                ]);
            }

            $applyChangeGuarantor->remove_approvals();
            $applyChangeGuarantor->make_approvals('ChangeGuarantor');

            session()->flash('message', 'Change Guarantor Application Successfully Applied');
            session()->flash('time', 10000);
            session()->flash('success');
            session()->flash('title');

            return redirect('home');
        } else {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text'  => 'To change guarantor, you must atleast change 1 guarantor',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 4500,
            ]);
        }
    }

    public function alertConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',
            'text'      => 'Are you sure you want to change your guarantor(s)?',
        ]);
    }

    public function render()
    {
        $this->fms_cust         = Customer::where([['client_id', $this->client_id], ['identity_no', $this->user->icno]])->firstOrFail();
        $this->siskop_cust      = SiskopCustomer::where('identity_no', $this->user->icno)->where('client_id', $this->client_id)->first();


        $membership             = $this->fms_cust->fmsMembership;

        $this->acct_master      = $membership->fmsAcctMaster;
        $this->acct_position   = [];

        foreach ($this->acct_master as $item) {
            $account_info = $item->account_no;
            $acct_position = AccountPosition::where('account_no', $account_info)
                ->where('client_id', $this->client_id)
                ->first();
            if ($acct_position->bal_outstanding > 0)
                $this->acct_position[] = $acct_position;
        }

        if ($this->clicked == 1) {
            $this->guarantor = GuarantorList::where('account_no', $this->acct_no)->where('client_id', $this->client_id)->get();
            foreach ($this->guarantors as $index => $guarantor) {
                $this->searchNRIC[$index] = '';
                $this->mbrNos[$index] = '';
                $this->names[$index] = '';
            }
        }
        return view('livewire.page.application.apply-change-guarantor.index')->extends('layouts.head');
    }
}
