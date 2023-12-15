<div>
<div x-data="{ activeTab: @entangle('numpage') }">
    <!-- Customer Details -->
    <div x-show="active == 0">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Customer Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                <div>
                    <x-form.dropdown
                        label="Title"
                        value=""
                        name="Cust.title_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="Cust.title_id"
                    >
                        @foreach ($title_id as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.input
                        label="Full Name"
                        name="Cust.name"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Cust.name"
                        oninput="this.value = this.value.toUpperCase()"
                    />
                </div>
                <div>
                    <x-form.input
                        label="IC Number"
                        name="Cust.identity_no"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Cust.identity_no"
                    />
                </div>
                <div>
                    <x-form.input
                        label="Birthdate"
                        name="Cust.birthdate"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                        wire:model="Cust.birthdate"
                    />
                </div>
                <div>
                    <x-form.input
                        label="Mobile Number"
                        name="Cust.phone"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Cust.phone"
                    /> 
                </div>
                <div>
                    <x-form.input
                        label="Email"
                        name="Cust.email"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Cust.email"
                    />
                </div>
                <div>
                    <x-form.dropdown
                        label="Race"
                        value=""
                        name="Cust.race_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="Cust.race_id"
                    >
                        @foreach ($race_id as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.dropdown
                        label="Gender"
                        value=""
                        name="Cust.gender_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="Cust.gender_id"
                    >
                        @foreach ($gender_id as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.dropdown
                        label="Education"
                        value=""
                        name="Cust.education_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="Cust.education_id"
                    >
                        @foreach ($education_id as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.dropdown
                        label="Marital"
                        value=""
                        name="Cust.marital_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="Cust.marital_id"
                    >
                        @foreach ($marital_id as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.dropdown
                        label="Religion"
                        value=""
                        name="Cust.religion_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="Cust.religion_id"
                    >
                        @foreach ($religion_id as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.dropdown
                        label="Bank"
                        value=""
                        name="Cust.bank_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="Cust.bank_id"
                    >
                        @foreach ($bank_id as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.input
                    label="Account Bank No."
                        name="Cust.bank_acct_no"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Cust.bank_acct_no"
                    /> 
                </div>
       
            </div>
        </div>
    </div>

    <!-- Address Details -->
    <div  x-show="active == 1">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Address Details {{$this->mail_flag_employer}}</h2>
            <div class="grid grid-cols-1 mt-4  gap-2">
                <div>
                    <x-form.address class="mt-2"
                        label="Home Address"
                        mandatory=""
                        disable=""
                        name1="CustAddress.address1"
                        name2="CustAddress.address2"
                        name3="CustAddress.address3"
                        name4="CustAddress.town"
                        name5="CustAddress.postcode"
                        name6="CustAddress.state_id"
                        name7="mail_flag"
                        :state="$state_id"
                        condition="state"
                        mailFlag="true"
                    />
                </div>
                <div class="grid grid-cols-1 mt-4 gap-2">
                    <div>
                        <x-form.address class="mt-2"
                            label="Office Address"
                            mandatory=""
                            disable=""
                            name1="EmployAddress.address1"
                            name2="EmployAddress.address2"
                            name3="EmployAddress.address3"
                            name4="EmployAddress.town"
                            name5="EmployAddress.postcode"
                            name6="EmployAddress.state_id"
                            name7="mail_flag_employer"
                            :state="$state_id"
                            condition="state"
                            mailFlag="true"
                        /> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Family Details -->
    <div x-show="active == 2">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Family Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                <div>
                    <x-form.input
                        label="Full Name"
                        name="CustFamily.name"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="CustFamily.name"
                        oninput="this.value = this.value.toUpperCase()"
                    /> 
                </div>
                <div>
                    <x-form.input
                        label="Email"
                        name=""
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="CustFamily.email"
                    /> 
                </div>
                <div>
                    <x-form.input
                        label="IC Number"
                        name="CustFamily.identity_no"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="CustFamily.identity_no"
                    />
                </div>
                <div>
                    <x-form.dropdown
                        label="Relationship"
                        value=""
                        name="CustFamily.relation_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="CustFamily.relation_id"
                    >
                    @foreach ($relationship as $list)
                        <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.input
                        label="Mobile Number"
                        name="CustFamily.phone_no"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="CustFamily.phone_no"
                    />
                </div>
                <div>
                    <x-form.dropdown
                        label="Race"
                        value=""
                        name="CustFamily.race_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="CustFamily.race_id"
                    >
                        @foreach ($race_id as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.dropdown
                        label="Religion"
                        value=""
                        name="CustFamily.religion_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="CustFamily.religion_id"
                    >
                        @foreach ($religion_id as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.input
                        label="Employer Name"
                        name="CustFamily.employer_name"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="CustFamily.employer_name"
                        oninput="this.value = this.value.toUpperCase()"
                    />
                </div>
                <div>
                    <x-form.input
                        label="Work Position"
                        name="CustFamily.work_post"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="CustFamily.work_post"
                        oninput="this.value = this.value.toUpperCase()"
                    />
                </div>
                <div>
                 
                    <x-form.input-tag
                        label="Salary"
                        name="CustFamily.salary"
                        value=""
                        mandatory=""
                        leftTag="RM"
                        rightTag=""
                        disable=""
                        type="text"
                        wire:model="CustFamily.salary"
                    /> 

                </div>
            </div>
            {{-- <div class="grid grid-cols-1 mt-4  gap-2">
                <div>
                    <x-form.address class="mt-2"
                        label="Home Address"
                        mandatory=""
                        disable=""
                        name1="FamilyAddress.address1"
                        name2="FamilyAddress.address2"
                        name3="FamilyAddress.address3"
                        name4="FamilyAddress.town"
                        name5="FamilyAddress.postcode"
                        name6="FamilyAddress.state_id"
                        :state="$state_id"
                        condition="state"
                        mailFlag="true"
                    />
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Work Details -->
    <div x-show="active == 3">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Work Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                <div>
                    <x-form.input
                        label="Company Name"
                        name="Employer.name"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Employer.name"
                    />
                </div>
                <div>
                    <x-form.input
                        label="Name Of Department"
                        name="Employer.department"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Employer.department"
                    /> 
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-4 gap-2">
                {{-- <div>
                    <x-form.dropdown
                        label="Sector"
                        value=""
                        name=""
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model=""
                    >
                        <option value="1">GOV</option>
                        <option value="2">private</option>
                        <option value="3">semi-gov</option>
                    </x-form.dropdown>
                </div> 
                <div>
                    <x-form.dropdown
                        label="Work Status"
                        value=""
                        name=""
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model=""
                    >
                        <option value="">Unemployed</option>
                        <option value="">Permanent</option>
                        <option value="">Full-Time Contract</option>
                        <option value="">Part-Time</option>
                        <option value="">Internship</option>
                        <option value="">Casual</option>
                        <option value="">Self-Employed</option>
                        <option value="">Pensioner/Retired</option>
                        <option value="">Temporary</option>
                        <option value="">Probation</option>
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.input
                        label="Staff No"
                        name=""
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model=""
                    /> 
                </div>--}}
                <div>
                    <x-form.input
                        label="Start Work Date"
                        name="Employer.work_start"
                        value=""
                        mandatory=""
                        disable=""
                        type="date"
                        wire:model="Employer.work_start"
                    /> 
                </div>
                <div>
                    <x-form.input
                        label="Position"
                        name="Employer.position"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Employer.position"
                    /> 
                </div>
                <div>
                    <x-form.input
                        label="Office Telephone Number (General Line)"
                        name="Employer.office_num"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Employer.office_num"
                    /> 
                </div>
                <div>
                    <x-form.input-tag
                        label="Salary"
                        name="Employer.salary"
                        value=""
                        mandatory=""
                        leftTag="RM"
                        rightTag=""
                        disable=""
                        type="text"
                        wire:model="Employer.salary"
                    /> 
                </div>
                {{-- <div>
                    <x-form.input
                        label="Salary No"
                        name="Employer.salary_ref"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model=""
                    /> 
                </div> --}}
                {{-- <div>
                    <x-form.input-tag
                        label="Monthly Allowance"
                        name=""
                        value=""
                        mandatory=""
                        leftTag="RM"
                        rightTag=""
                        disable=""
                        type="text"
                        wire:model=""
                    /> 
                </div> --}}
                <div>
                    <x-form.input
                        label="Work Phone (Optional)"
                        name="Employer.worker_num"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Employer.worker_num"
                    /> 
                </div>
                {{--<div>
                    <x-form.input
                        label="Work Email"
                        name=""
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model=""
                    /> 
                </div>
                 <div>
                    <x-form.input
                        label="Extension"
                        name=""
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model=""
                    /> 
                </div>
                <div>
                    <x-form.input
                        label="Start Pension Date"
                        name=""
                        value=""
                        mandatory=""
                        disable=""
                        type="date"
                        wire:model=""
                    /> 
                </div>
                <div>
                    <x-form.input
                        label="Start Pension Age "
                        name=""
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model=""
                    /> 
                </div> --}}
            </div>
        </div>
    </div>

    <div x-show="active == 0">
        <div class="px-6">
            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-800">
                <div class="flex items-center justify-center space-x-2">
                    <button type="button" wire:click="next({{$numpage}},0)" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="active == 1 || active == 2 || active == 3">
        <div class="px-6">
            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-800">
                <div class="flex items-center justify-center space-x-2">
                    <button type="button" wire:click="previous" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Previous
                    </button>
                    <button type="button" wire:click="next({{$numpage}},0)" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>