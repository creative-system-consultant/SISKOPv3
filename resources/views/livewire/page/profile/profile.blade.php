<div class="p-4">
    <x-form.basic-form wire:submit.prevent="submit('{{ $User->id }}')" class="p-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> User Details </h2>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 ">
            <x-form.input
                label="Full Name"
                id="FmsCust.name"
                name="FmsCust.name"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="FmsCust.name"
            />
            <x-form.input
                label="IC Number"
                id="FmsCust.identity_no"
                name="FmsCust.identity_no"
                value=""
                mandatory="true"
                disable="true"
                type="text"
                wire:model="FmsCust.identity_no"
            />
            <x-form.input
                label="Phone No"
                id="FmsCust.phone"
                name="FmsCust.phone"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="FmsCust.phone"
            />
            <x-form.input
                label="Email"
                id="FmsCust.email"
                name="FmsCust.email"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="FmsCust.email"
            />

            <x-form.dropdown
                label="Bank"
                value=""
                name="FmsCust.bank_id"
                id=""
                mandatory=""
                disable=""
                default="yes"
                wire:model="FmsCust.bank_id"
            >
                @foreach ($bank_id as $list)
                    <option value="{{ $list->code }}"> {{ $list->description }}</option>
                @endforeach
            </x-form.dropdown>

            <x-form.input
                label="Account Bank No."
                name="FmsCust.bank_acct_no"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model="FmsCust.bank_acct_no"
            /> 
        </div>


        <h2 class="mb-4 pt-6 text-base font-semibold border-b-2 border-gray-300"> Work Details </h2>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 ">
            <x-form.input
                label="Company Name"
                id="Employer.name"
                name="Employer.name"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="Employer.name"
            />
            <x-form.input
                label="Name of Department"
                id="Employer.department"
                name="Employer.department"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="Employer.department"
            />
            <x-form.input
                label="Position"
                id="Employer.position"
                name="Employer.position"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="Employer.position"
            />
            <x-form.input
                label="Office Telephone Number (General Line)"
                id="Employer.office_num"
                name="Employer.office_num"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="Employer.office_num"
            />
            <x-form.input
                label="Salary"
                id="Employer.salary"
                name="Employer.salary"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="Employer.salary"
            />
        </div>
        
        <h2 class="mb-4 pt-6 text-base font-semibold border-b-2 border-gray-300"> Addresses </h2>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 ">
            <div>
                <x-form.address class="mt-2"
                    label="Home Address"
                    mandatory=""
                    disable=""
                    name1="FmsAddressCust.address1"
                    name2="FmsAddressCust.address2"
                    name3="FmsAddressCust.address3"
                    name4="FmsAddressCust.town"
                    name5="FmsAddressCust.postcode"
                    name6="FmsAddressCust.state_id"
                    name7="mail_flag"
                    :state="$state_id"
                    condition="state"
                    mailFlag="true"
                />
            </div>
            <div>
                <x-form.address class="mt-2"
                    label="Office Address"
                    mandatory=""
                    disable=""
                    name1="FmsAddressEmployer.address1"
                    name2="FmsAddressEmployer.address2"
                    name3="FmsAddressEmployer.address3"
                    name4="FmsAddressEmployer.town"
                    name5="FmsAddressEmployer.postcode"
                    name6="FmsAddressEmployer.state_id"
                    name7="mail_flag_employer"
                    :state="$state_id"
                    condition="state"
                    mailFlag="true"
                /> 
            </div>
        </div>

            <h2 class="mb-4 pt-6 text-base font-semibold border-b-2 border-gray-300">Family Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                <div>
                    <x-form.input
                        label="Full Name"
                        name="FmsCustFamily.name"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="FmsCustFamily.name"
                        oninput="this.value = this.value.toUpperCase()"
                    /> 
                </div>
                <div>
                    <x-form.input
                        label="Email"
                        name="FmsCustFamily.email"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="FmsCustFamily.email"
                    /> 
                </div>
                <div>
                    <x-form.input
                        label="IC Number"
                        name="FmsCustFamily.identity_no"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="FmsCustFamily.identity_no"
                    />
                </div>
                <div>
                    <x-form.dropdown
                        label="Relationship"
                        value=""
                        name="FmsCustFamily.relation_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="FmsCustFamily.relation_id"
                    >
                    @foreach ($relationship as $list)
                        <option value="{{ $list->code }}"> {{ $list->description }}</option>
                    @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.input
                        label="Mobile Number"
                        name="FmsCustFamily.phone_no"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="FmsCustFamily.phone_no"
                    />
                </div>
                <div>
                    <x-form.dropdown
                        label="Race"
                        value=""
                        name="FmsCustFamily.race_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="FmsCustFamily.race_id"
                    >
                        @foreach ($race_id as $list)
                            <option value="{{ $list->code }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.dropdown
                        label="Religion"
                        value=""
                        name="FmsCustFamily.religion_id"
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="FmsCustFamily.religion_id"
                    >
                        @foreach ($religion_id as $list)
                            <option value="{{ $list->code }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>
                <div>
                    <x-form.input
                        label="Employer Name"
                        name="FmsCustFamily.employer_name"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="FmsCustFamily.employer_name"
                        oninput="this.value = this.value.toUpperCase()"
                    />
                </div>
                <div>
                    <x-form.input
                        label="Work Position"
                        name="FmsCustFamily.work_post"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="FmsCustFamily.work_post"
                        oninput="this.value = this.value.toUpperCase()"
                    />
                </div>
                <div>
                 
                    <x-form.input-tag
                        label="Salary"
                        name="FmsCustFamily.salary"
                        value=""
                        mandatory=""
                        leftTag="RM"
                        rightTag=""
                        disable=""
                        type="text"
                        wire:model="FmsCustFamily.salary"
                    /> 

                </div>
            </div>
 
        

        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <a href="{{ url()->previous() }}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                    Cancel
                </a>
                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Update
                </button>
            </div>
        </div>
    </x-form.basic-form>
</div>

@push('js')
<script>
    window.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('redirect', function() {
            alert('Redirect event received');
            window.location.href = "{{ route('Index') }}";
        });
    });
</script>


@endpush