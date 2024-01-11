<?php

namespace App\Http\Livewire\Page\Application\Membership;

use App\Models\User;
use App\Models\Address;
use App\Models\ApplyMembership;
use App\Models\Client as Coop;
use App\Models\Customer as FMSCustomer;
use App\Models\FmsGlobalParm;
use App\Models\SiskopCustomer as Customer;
use App\Models\SiskopEmployer as CustEmployer;
use App\Models\SiskopFamily as CustFamily;
use App\Models\Ref\RefBank;
use App\Models\Ref\RefCustTitle;
use App\Models\Ref\RefEducation;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefRelationship;
use App\Models\Ref\RefReligion;
use App\Models\Ref\RefState;
use App\Models\SiskopAddress;
use App\Models\SysOptions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class NewMembership extends Component
{
    use WithFileUploads;

    public User $User;
    public ApplyMembership $applymember;
    public Coop $Coop;
    public Customer $Cust;
    public CustFamily $CustFamily;
    public FMSCustomer $CustIntroducer;
    public CustEmployer $Employer;
    public SiskopAddress $CustAddress;
    public Address $EmployAddress;

    public $applyStatus;
    public $apply_id;
    public $Introducer;
    public $field;
    public $document;
    public $title_id;
    public $education_id;
    public $religion_id;
    public $bank_id;
    public $gender_id;
    public $marital_id;
    public $relationship;
    public $race_id;
    public $state_id;
    public $name;
    public $identity_no;
    public $email;
    public $mobile_num;
    public $online_file;
    public $online_file2;
    public $online_file3;
    public $globalParm;
    public $online_file4;
    public $payment_file_regist;
    public $payment_file_share;
    public $monthly_share;
    public $total_deduction;
    public $Ftotal_deduction;
    public $Mtotal_deduction;
    public $min_contribution_fee;
    public $search;
    public $mbr_no = [];
    public $birthdate;
    public $activeTab = 0;
    public $numpage = 1;
    public $tab1 = 1, $tab2 = 0, $tab3 = 0, $tab4 = 0, $tab5 = 0, $tab6 = 0, $tab7 = 0, $tab8 = 0;
    public $pay_type_regist, $pay_type_share;
    public $mail_flag, $mail_flag_employer;
    public $tot_share, $cust_bank_id, $cust_bank_id2, $client_bank_id, $client_bank_acct, $client_bank_name, $bankLength;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];

    protected $rule1 = [
        'Cust.name'                          => ['required', 'regex:/^[A-Za-z @\/-]+$/'],
        'Cust.identity_no'                   => 'required|numeric|digits:12',
        'Cust.phone'                         => ['required', 'regex:/^\d{7,11}$/'],
        'Cust.birthdate'                     => 'required',
        'Cust.race_id'                       => 'required',
        'Cust.gender_id'                     => 'required',
        'Cust.education_id'                  => 'required',
        'Cust.marital_id'                    => 'required',
        'Cust.email'                         => 'required|email',
        'Cust.title_id'                      => 'required',
        'Cust.religion_id'                   => 'required',
        'Cust.bank_id'                       => 'required',
        // 'Cust.bank_acct_no'                  => 'required|regex:/^\d{11}$/',

    ];

    protected $rule2 = [
        'CustAddress.address1'               => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'CustAddress.address2'               => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'CustAddress.address3'               => 'nullable',
        'CustAddress.postcode'               => 'required|digits:5',
        'CustAddress.town'                   => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'CustAddress.state_id'               => 'required',
        'mail_flag'                          => 'nullable',
        'EmployAddress.address1'             => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'EmployAddress.address2'             => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'EmployAddress.address3'             => 'nullable',
        'EmployAddress.postcode'             => 'required|digits:5',
        'EmployAddress.town'                 => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'EmployAddress.state_id'             => 'required',
        'mail_flag_employer'                 => 'nullable',
    ];

    protected $rule3 = [
        'CustFamily.name'                    => ['required', 'regex:/^[A-Za-z @\/-]+$/'],
        'CustFamily.identity_no'             => 'required|numeric|digits:12',
        'CustFamily.email'                   => ['required', 'email:rfc', 'regex:/^[\w\.-]+@[\w\.-]+\.\w+$/'],
        'CustFamily.phone_no'                => ['required', 'regex:/^\d{7,11}$/'],
        'CustFamily.relation_id'             => 'required',
        'CustFamily.race_id'                 => 'required',
        'CustFamily.religion_id'             => 'required',
        'CustFamily.employer_name'           => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&()]+$/'],
        'CustFamily.work_post'               => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&()]+$/'],
        'CustFamily.salary'                  =>  ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
    ];

    protected $rule4 = [
        'Employer.name'                      => ['required', 'regex:/^[A-Za-z @\/-]+$/'],
        'Employer.department'                => 'required',
        'Employer.position'                  => 'required',
        'Employer.office_num'                => ['required', 'regex:/^\d{7,11}$/'],
        'Employer.salary'                    =>  ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        'Employer.worker_num'                => ['nullable', 'regex:/^\d{7,11}$/'],
        'Employer.work_start'                => 'required|date|before_or_equal:today',
    ];

    protected $rule5 = [
        'CustIntroducer.mbr_no'                  => 'nullable',
        'CustIntroducer.icno'                    => 'nullable|numeric|digits:12',
    ];

    protected $rule6 = [
        'applymember.register_fee'           => 'required|gte:50|numeric',
        'applymember.share_fee'              => 'required|gte:50|numeric',
        'applymember.contribution_fee'       => 'required|gte:50|numeric',
        'applymember.share_monthly'          => 'required|gte:50|numeric',
        'applymember.total_fee'              => 'required|numeric',
        'pay_type_regist'                    => 'required',
        'pay_type_share'                     => 'required',

    ];

    protected $rules = [
        'Cust.name'                          => 'required',
        'Cust.identity_no'                   => 'required',
        'Cust.phone'                         => 'required',
        'Cust.birthdate'                     => 'required',
        'Cust.race_id'                       => 'required',
        'Cust.gender_id'                     => 'required',
        'Cust.education_id'                  => 'required',
        'Cust.marital_id'                    => 'required',
        'Cust.email'                         => 'required',
        'Cust.title_id'                      => 'required',
        'Cust.religion_id'                   => 'required',
        'Cust.bank_id'                       => 'required',
        'Cust.bank_acct_no'                  => 'required',
        'CustAddress.address1'               => 'required',
        'CustAddress.address2'               => 'required',
        'CustAddress.address3'               => 'nullable',
        'CustAddress.postcode'               => 'required',
        'CustAddress.town'                   => 'required',
        'CustAddress.state_id'               => 'required',
        // 'CustAddress.mail_flag'              => 'required',
        'Employer.name'                      => 'required',
        'Employer.department'                => 'required',
        'Employer.position'                  => 'required',
        'Employer.office_num'                => 'required',
        'Employer.salary'                    => 'required',
        'Employer.worker_num'                => 'required',
        'Employer.work_start'                => 'required',
        // 'EmployAddress.mail_flag'            => 'required',
        'EmployAddress.address1'             => 'required',
        'EmployAddress.address2'             => 'required',
        'EmployAddress.address3'             => 'nullable',
        'EmployAddress.postcode'             => 'required',
        'EmployAddress.town'                 => 'required',
        'EmployAddress.state_id'             => 'required',
        'CustFamily.name'                    => 'required',
        'CustFamily.identity_no'             => 'required',
        'CustFamily.email'                   => 'required',
        'CustFamily.phone_no'                => 'required',
        'CustFamily.relation_id'             => 'required',
        'CustFamily.race_id'                 => 'required',
        'CustFamily.religion_id'             => 'required',
        'CustFamily.employer_name'           => 'required',
        'CustFamily.work_post'               => 'required',
        'CustFamily.salary'                  => 'required',
        'CustIntroducer.name'                => 'required',
        'CustIntroducer.icno'                => 'nullable',
        'CustIntroducer.email'               => 'nullable',
        'CustIntroducer.mbr_no'              => 'nullable',
        'pay_type'                           => 'nullable',
        'search'                             => 'nullable',
        'applymember.register_fee'           => 'required|gte:50|numeric',
        'applymember.share_fee'              => 'required|gte:50|numeric',
        'applymember.contribution_fee'       => 'required|gte:50|numeric',
        'applymember.share_monthly'          => 'required|gte:50|numeric',
        'applymember.total_fee'              => 'required|numeric',
        'applymember.cust_bank_id'           => 'required',
        'applymember.client_bank_id'         => 'required',
        'applymember.client_bank_acct_no'       => 'required',
    ];

    public function getSpecialRules()
    {
        return [
            'Cust.bank_acct_no' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if (!$this->Cust->bank_id) {
                        return $fail("The bank ID is not selected.");
                    }

                    $bankAccountLength = RefBank::where('id', $this->Cust->bank_id)->value('bank_acc_len');

                    if (!$bankAccountLength) {
                        return $fail("Unable to determine the bank account length.");
                    }

                    if (strlen((string) $value) != $bankAccountLength) {
                        $fail("The Account Number must be exactly {$bankAccountLength} characters.");
                    }
                },
            ],
        ];
    }

    public function getIntroducerRules()
    {

        $rules = [
            'search' => [
                'nullable',
            ],
        ];

        $optionFlag = SysOptions::where('client_id', $this->User->client_id)->where('option_code', 106)->value('option_flag');
        if ($optionFlag == 'Y') {
            $rules['search'][] = ['required', 'numeric', 'digits:12'];
            $rules['CustIntroducer.name'][] = ['required', 'regex:/^[A-Za-z0-9 @\/-]+$/'];
            $rules['CustIntroducer.icno'][] = ['required', 'numeric', 'digits:12'];
            $rules['CustIntroducer.email'][] = 'email';
        }

        return $rules;
    }

    public function previous()
    {
        if ($this->numpage > 1 && $this->numpage <= 8) {
            $this->dispatchBrowserEvent('decrement-tab');
            $this->numpage--;
        }
    }

    public function next($newPage, $tab)
    {

        $this->numpage = $newPage;
        $mail_flag_checker = 1;
        if ($tab != 1) {
            switch ($this->numpage) {
                case 1:
                    $this->validate($this->rule1);
                    $this->validate($this->getSpecialRules());
                    $this->birthdate();
                    $this->Cust->save();
                    $this->tab2 = 1;
                    break;
                case 2:
                    $this->validate($this->rule2);
                    if (!($this->mail_flag_employer == 1 && $this->mail_flag == 1) && !($this->mail_flag_employer == 0 && $this->mail_flag == 0)) {
                        $custAddress = $this->CustAddress;
                        $custAddress->address1 = rtrim($custAddress->address1, ',');
                        $custAddress->address2 = rtrim($custAddress->address2, ',');
                        $custAddress->save();
                        $employAddress = $this->EmployAddress;
                        $employAddress->address1 = rtrim($employAddress->address1, ',');
                        $employAddress->address2 = rtrim($employAddress->address2, ',');
                        $employAddress->save();
                        $this->tab3 = 1;
                    } else {
                        $this->dispatchBrowserEvent('swal', [
                            'title' => 'Warning!',
                            'text'  => 'You must pick one Mailing Flag',
                            'icon'  => 'warning',
                            'showConfirmButton' => false,
                            'timer' => 10000,
                        ]);
                        $mail_flag_checker = 0;
                    }

                    break;
                case 3:
                    if ($this->CustFamily->identity_no === $this->Cust->identity_no) {
                        $this->addError('CustFamily.identity_no', 'Identity number must not be the same as Applicant identity number.');
                        $mail_flag_checker = 0;
                    } else {
                        $this->validate($this->rule3);
                        $this->CustFamily->name = Str::upper($this->CustFamily->name);
                        $this->CustFamily->save();
                        $this->CustFamily->save();
                        $this->tab4 = 1;
                    }
                    break;
                case 4:
                    $dob = Carbon::createFromFormat('Y-m-d', $this->Cust->birthdate);
                    $workstart = Carbon::createFromFormat('Y-m-d', $this->Employer->work_start);
                    $age = $dob->diffInYears($workstart);
                    if ($age < 18) {
                        $this->addError('Employer.work_start', 'Work start and birthday should be more than 18 years');
                        $mail_flag_checker = 0;
                    } else {
                        $this->validate($this->rule4);
                        $this->Employer->save();
                        $this->tab5 = 1;
                    }
                    break;
                case 5:
                    $this->validate($this->rule5);
                    $this->validate($this->getIntroducerRules());
                    $this->Introducer->intro_cust_id = $this->CustIntroducer->id;
                    $this->Introducer->save();
                    $this->tab6 = 1;
                    break;
                case 6:
                    $this->totalfee();
                    $this->validate($this->rule6);
                    $this->applymember->cust_bank_id = $this->cust_bank_id;
                    $this->applymember->client_bank_id = $this->client_bank_id;
                    $this->applymember->client_bank_acct_no = $this->client_bank_acct;
                    $this->applymember->share_pmt_mode_flag = $this->pay_type_share;
                    $this->applymember->register_fee_flag = $this->pay_type_regist;
                    $this->applymember->contribution_monthly = $this->applymember->contribution_fee;
                    if ($this->pay_type_share == '1') {
                        $this->applymember->share_lump_sum_amt = $this->tot_share;
                    } else {
                        $this->applymember->share_lump_sum_amt = 0;
                    }
                    $this->applymember->save();
                    $this->tab7 = 1;
                    break;
                case 7:
                    // $this->validate($this->rule7);
                    $this->fileupload();
                    $this->tab8 = 1;
                    break;
            }
            if ($mail_flag_checker != 0) {
                $this->dispatchBrowserEvent('increment-tab');
                $this->numpage++;
            }
        }



        $this->render();
    }

    public function nextTab($curPage, $newPage, $tab)
    {
        $this->activeTab = $newPage - 1;

        $this->numpage = $newPage;
        if ($tab == 1) {
            switch ($curPage) {
                case 1:
                    $this->validate($this->rule1);
                    $this->validate($this->getSpecialRules());
                    $this->birthdate();
                    $this->Cust->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
                case 2:
                    $this->validate($this->rule2);
                    if (!($this->mail_flag_employer == 1 && $this->mail_flag == 1) && !($this->mail_flag_employer == 0 && $this->mail_flag == 0)) {
                        $this->CustAddress->save();
                        $this->EmployAddress->save();
                        $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);
                    } else {
                        $this->dispatchBrowserEvent('swal', [
                            'title' => 'Warning!',
                            'text'  => 'You must pick one Mailing Flag',
                            'icon'  => 'warning',
                            'showConfirmButton' => false,
                            'timer' => 10000,
                        ]);
                    }
                    break;
                case 3:
                    $this->validate($this->rule3);
                    $this->CustFamily->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);
                    break;
                case 4:
                    $this->validate($this->rule4);
                    $this->Employer->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
                case 5:
                    $this->validate($this->rule5);
                    $this->validate($this->getIntroducerRules());
                    $this->Introducer->intro_cust_id = $this->CustIntroducer->id;
                    $this->Introducer->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
                case 6:
                    $this->totalfee();
                    $this->validate($this->rule6);
                    $this->applymember->cust_bank_id = $this->cust_bank_id;
                    $this->applymember->client_bank_id = $this->client_bank_id;
                    $this->applymember->client_bank_acct_no = $this->client_bank_acct;
                    $this->applymember->share_pmt_mode_flag = $this->pay_type_share;
                    $this->applymember->register_fee_flag = $this->pay_type_regist;
                    $this->applymember->contribution_monthly = $this->applymember->contribution_fee;

                    if ($this->pay_type_share == '1') {
                        $this->applymember->share_lump_sum_amt = $this->tot_share;
                    } else {
                        $this->applymember->share_lump_sum_amt = 0;
                    }
                    $this->applymember->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
                case 7:
                    // $this->validate($this->rule7);
                    $this->fileupload();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
            }
        }


        $this->render();
    }

    public function updatingMailFlag()
    {
        if ($this->mail_flag == 1) {
            $this->mail_flag = NULL;
            $this->CustAddress->mail_flag = NULL;
        } else {
            $this->mail_flag = 1;
            $this->CustAddress->mail_flag = 1;
        }
        $this->CustAddress->save();
    }
    public function updatingMailFlagEmployer()
    {
        if ($this->mail_flag_employer == 1) {
            $this->mail_flag_employer = NULL;
            $this->EmployAddress->mail_flag = NULL;
        } else {
            $this->mail_flag_employer = 1;
            $this->EmployAddress->mail_flag = 1;
        }
        $this->EmployAddress->save();
    }

    public function searchUser()
    {

        // if (strlen($this->search) == 12) {
        $result = FMSCustomer::with('fmsMembership')->where('identity_no', $this->search)->whereHas('fmsMembership', function ($query) {
            $query->where('mbr_status', 'A')->where('client_id', $this->User->client_id);
        })->first();
        // dump('135');

        if ($result == NULL) {
            $this->addError('search', 'No User with this IC');
            // dump('1035');
        } else if ($result->fmsMembership->refMemStat->allow_introducer_flag == "N") {
            $this->addError('search', 'This user is unable to be an introducer');
        } else {
            $this->CustIntroducer = $result;
            $this->resetErrorBag('search');
            // dump('1036');
        }
        // }
    }

    public function updatedCustIcno()
    {
        $this->Cust->birthdate = $this->birthdate();
    }

    public function birthdate()
    {
        $tempIC     = substr($this->Cust->identity_no, 0, 6);   //yymmdd
        $tempyear   = substr($tempIC, 0, 2);             //yy
        $tempmonth  = substr($tempIC, 2, 2);             //mm
        $tempday    = substr($tempIC, 4, 2);             //dd

        if ($tempyear > now()) {
            $tempyear = '19' . $tempyear;
        } else {
            $tempyear = '20' . $tempyear;
        }
        $this->birthdate  = $tempyear . '-' . $tempmonth . '-' . $tempday;
        return $this->birthdate;
    }

    public function gender()
    {
        $tempGender  = substr($this->Cust->identity_no, 0, 12);
        if ($tempGender % 2 == 0) {
            $tempGender = 'F';
        } else {
            $tempGender = 'M';
        }
        return $tempGender;
    }

    public function callSP()
    {
        $sql =  "EXEC fmsv2_dev.SISKOP.up_insert_customer_fms " . $this->User->client_id . " ," . $this->apply_id . ", 10 ";
        DB::statement($sql);
    }


    public function mount()
    {
        $this->User = auth()->user();
        $this->Coop = Coop::find($this->User->client_id);
        $this->Cust = Customer::firstOrCreate([
            'identity_no' => $this->User->icno,
            'client_id' => $this->Coop->id
        ], [
            'name'      => $this->User->name,
            'phone'     => $this->User->phone_no,
        ]);

        $this->applymember = ApplyMembership::firstOrCreate(['cust_id' => $this->Cust->id, 'client_id' => $this->User->client_id], ['user_id' => $this->User->id]);
        $this->globalParm = FmsGlobalParm::where('client_id', $this->User->client_id)->first();
        $this->applymember->register_fee = 50;
        $this->applymember->share_fee = $this->globalParm->MIN_SHARE;
        $this->applymember->contribution_fee = $this->globalParm->MIN_CONTRIBUTION;
        $this->min_contribution_fee = $this->globalParm->MIN_CONTRIBUTION;
        $this->monthly_share = $this->globalParm->MIN_SHARE / $this->globalParm->TOT_MTH_SHARE_INSTALMENT;
        $this->applymember->save();

        $this->apply_id = $this->applymember->id;
        $this->Cust->apply_id = $this->apply_id;
        $this->Cust->save();

        $this->Cust->email = $this->Cust->email ?? $this->User->email;
        if ($this->Cust->ref_no != NULL) {
            session()->flash('message', 'You are already a member of ' . $this->Coop->name);
            session()->flash('time', 10000);
            session()->flash('warning');
            session()->flash('title');

            return redirect()->route('home');
        }

        $this->Cust->birthdate = $this->birthdate();
        $this->Cust->gender_id = $this->gender();

        $this->CustAddress = $this->Cust->Address()->firstOrCreate(
            [
                'cif_id' => $this->Cust->id,
                'client_id' => $this->User->client_id,
                'apply_id' => $this->apply_id,
                'address_type_id' => '2',
            ]
        );

        $this->mail_flag = $this->CustAddress->mail_flag;
        $this->CustFamily = CustFamily::firstOrCreate([
            'cif_id'        => $this->Cust->id,
            'client_id'     => $this->User->client_id,
            'apply_id'      => $this->apply_id,
        ], []);

        $this->Introducer = $this->Cust->introducer()->firstOrCreate([], [
            'client_id' => $this->User->client_id,
            'apply_id' => $this->apply_id,
        ]);

        if ($this->Introducer != NULL) {
            $this->CustIntroducer = FMSCustomer::where('id', $this->Introducer->intro_cust_id)->firstOrNew();
            $this->search = $this->CustIntroducer->identity_no;
        }

        $this->Employer = CustEmployer::firstOrCreate(
            [
                'cust_id' => $this->Cust->id,
                'client_id' => $this->User->client_id,
                'apply_id' => $this->apply_id
            ]
        );
        $this->EmployAddress     = $this->Employer->Address()->firstOrCreate(
            [
                'cif_id' => $this->Cust->id,
                'client_id' => $this->User->client_id,
                'apply_id' => $this->apply_id,
                'address_type_id' => '3'
            ]
        );
        $this->mail_flag_employer = $this->EmployAddress->mail_flag;



        $this->title_id          = RefCustTitle::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->education_id      = RefEducation::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->gender_id         = RefGender::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->marital_id        = RefMarital::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->race_id           = RefRace::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->state_id          = RefState::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->religion_id       = RefReligion::where([['client_id', 1], ['status', '1']])->get();
        $this->bank_id           = RefBank::where([
            ['client_id', $this->User->client_id],
            ['status', '1'], ['bank_cust', 'Y']
        ])->orderBy('priority')->orderBy('description')->get();
        // dd($this->relationship);
        $this->applyStatus = FMSCustomer::where('identity_no', $this->User->icno)->where('client_id', $this->User->client_id)->first();
    }

    public function fileupload2()
    {
        if ($this->payment_file_regist) {
            $filepath = 'Files/' . $customers->id . '/membership/RegistrationPayment' . '.' . $this->payment_file_regist->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->payment_file_regist, 'RegistrationPayment' . '.' . $this->payment_file_regist->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'RegistrationPayment',
            ], [
                'filedesc' => 'Registration Payment Proof',
                'filetype' => $this->payment_file_regist->extension(),
                'filepath' => $filepath,
            ]);
        }

        if ($this->payment_file_share) {
            $filepath = 'Files/' . $customers->id . '/membership/SharePayment' . '.' . $this->payment_file_share->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->payment_file_share, 'SharePayment' . '.' . $this->payment_file_share->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'SharePayment',
            ], [
                'filedesc' => 'Share Payment Proof',
                'filetype' => $this->payment_file_share->extension(),
                'filepath' => $filepath,
            ]);
        }
        $this->render();
    }
    public function fileupload()
    {
        $customers = Customer::where('identity_no', $this->User->identity_no)->first();

        if ($this->online_file) {
            $filepath = 'Files/' . $customers->id . '/membership/IC_Photo' . '.' . $this->online_file->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->online_file, 'IC_Photo' . '.' . $this->online_file->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'IC_Photo',
            ], [
                'filedesc' => 'IC Photo (Front & Back)',
                'filetype' => $this->online_file->extension(),
                'filepath' => $filepath,
            ]);
        }

        if ($this->online_file2) {
            $filepath = 'Files/' . $customers->id . '/membership/WorkerCard' . '.' . $this->online_file2->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->online_file2, 'WorkerCard' . '.' . $this->online_file2->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'WorkerCard',
            ], [
                'filedesc' => 'Worker Card',
                'filetype' => $this->online_file2->extension(),
                'filepath' => $filepath,
            ]);
        }

        if ($this->online_file3) {
            $filepath = 'Files/' . $customers->id . '/membership/Paycheck' . '.' . $this->online_file3->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->online_file3, 'Paycheck' . '.' . $this->online_file3->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'Paycheck',
            ], [
                'filedesc' => 'Paycheck',
                'filetype' => $this->online_file3->extension(),
                'filepath' => $filepath,
            ]);
        }

        if ($this->online_file4) {
            $filepath = 'Files/' . $customers->id . '/membership/LastMonthPaycheck' . '.' . $this->online_file4->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->online_file4, 'LastMonthPaycheck' . '.' . $this->online_file4->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'LastMonthPaycheck',
            ], [
                'filedesc' => 'Last Month Paycheck',
                'filetype' => $this->online_file4->extension(),
                'filepath' => $filepath,
            ]);
        }

        if ($this->payment_file_regist) {
            $filepath = 'Files/' . $customers->id . '/membership/RegistrationPayment' . '.' . $this->payment_file_regist->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->payment_file_regist, 'RegistrationPayment' . '.' . $this->payment_file_regist->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'RegistrationPayment',
            ], [
                'filedesc' => 'Registration Payment Proof',
                'filetype' => $this->payment_file_regist->extension(),
                'filepath' => $filepath,
            ]);
        }

        if ($this->payment_file_share) {
            $filepath = 'Files/' . $customers->id . '/membership/SharePayment' . '.' . $this->payment_file_share->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->payment_file_share, 'SharePayment' . '.' . $this->payment_file_share->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'SharePayment',
            ], [
                'filedesc' => 'Share Payment Proof',
                'filetype' => $this->payment_file_share->extension(),
                'filepath' => $filepath,
            ]);
        }

        $this->render();
    }

    public function totalfee()
    {
        if (is_numeric($this->applymember->contribution_fee)) {
            $this->applymember->update([
                'total_fee' => $this->applymember->register_fee + $this->applymember->share_fee + $this->applymember->contribution_fee,
            ]);
        }
    }

    public function submit()
    {
        $this->applymember->make_approvals();
        $this->applymember->update([
            'flag' => 1,
            'step' => 1,
        ]);

        session()->flash('message', 'Membership Application Registered');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }

    public function submitto()
    {
        $customers = Customer::where('identity_no', $this->User->identity_no)->first();

        $this->validate();
        $this->fileupload();

        $this->Cust->save();
        $this->Employer->save();

        $this->Cust->address()->save($this->CustAddress);
        $this->applymember->introducers()->firstOrCreate([
            'intro_cust_id' => $this->introducer->id,
            'client_id'       => $this->User->client_id,
        ]);

        $this->applymember->update([
            'flag' => 1,
            'step' => 1,
        ]);



        session()->flash('message', 'Membership Application Registered');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }

    public function alertConfirm()
    {
        $message  = '<b>Name</b> : ' . $this->Cust->name . "<br>";
        $message .= '<b>Introducer</b> : ' . $this->CustIntroducer->name . "<br>";
        $message .= '<b>Register Fee</b> : RM' . $this->applymember->register_fee . "<br>";
        if ($this->pay_type_share == '2') {
            $message .= '<b>Share Fee (Instalment)</b> : RM' . $this->monthly_share . "<br>";
        } else {
            $message .= '<b>Share Fee </b> : RM' . $this->applymember->share_fee . "<br>";
        }
        $message .= '<b>Contribution Fee</b> : RM' . $this->applymember->contribution_fee . "<br>";
        if ($this->pay_type_share == '2') {
            $message .= '<b>Total Fee</b> : RM' . $this->Ftotal_deduction . "<br>";
        } else {
            $message .= '<b>Total Fee</b> : RM' . $this->applymember->total_fee . "<br>";
        }

        $this->dispatchBrowserEvent('swal:confirm', [
            'type'          => 'warning',
            'title'         => 'Are you sure you want to apply for membership?',
            'html'          => $message,
            'note'          => 'Please recheck all your details before click "Submit" button.',
        ]);
    }

    public function deb()
    {
        dd([
            'User'        => $this->User,
            'member'      => $this->Member,
            'applymember' => $this->applymember,
            'customer'    => $this->Cust,
            'custfamily'  => $this->CustFamily,
            //'family'      => $this->Family,
            'employer'    => $this->Employer,
            'address'     => $this->CustAddress,
            //'emp address' => $this->EmployAddress,
            'fam address' => $this->FamilyAddress,
            //'address fams' => $this->CustFamily->address()->firstOrCreate(),
        ]);
    }

    public function render()
    {
        if (!$this->Cust->gender_id) {
            $this->relationship      = RefRelationship::where('client_id', $this->User->client_id)->get();
        } else {
            $this->relationship      = RefRelationship::GenderSpecificList($this->Cust->gender_id, $this->User->client_id);
        }

        if ($this->Cust->bank_id) {
            $bank_name = RefBank::select('bank_acc_len')->where('id', $this->Cust->bank_id)->first();
        }
        if (is_numeric($this->applymember->contribution_fee)) {
            if ($this->pay_type_share == '2') {
                // $this->tot_share = $this->monthly_share;
                $this->applymember->share_monthly = $this->monthly_share;
                $this->total_deduction =  $this->monthly_share + $this->applymember->contribution_fee;
                $this->Ftotal_deduction =  $this->applymember->register_fee + $this->monthly_share + $this->applymember->contribution_fee;
                $this->Mtotal_deduction =   $this->applymember->contribution_fee;
            } else {
                $this->tot_share = $this->applymember->share_fee;
                $this->Ftotal_deduction =  $this->applymember->register_fee + $this->applymember->share_fee + $this->applymember->contribution_fee;
                $this->Mtotal_deduction =   $this->applymember->contribution_fee;

                // $this->total_deduction = $this->applymember->register_fee + $this->applymember->share_fee + $this->applymember->contribution_fee;
            }
        }
        if ($this->cust_bank_id || $this->cust_bank_id2) {
            $this->globalParm = FmsGlobalParm::where('client_id', $this->User->client_id)->first();

            $this->client_bank_id = $this->globalParm->DEF_CLIENT_BANK_ID;
            $bank_name = RefBank::select('description')->where('id', $this->client_bank_id)->first();
            $this->client_bank_name = $bank_name->description;
            $this->client_bank_acct = $this->globalParm->DEF_CLIENT_BANK_ACCT_NO;
        }

        return view('livewire.page.application.membership.new-membership')->extends('layouts.head');
    }
}
