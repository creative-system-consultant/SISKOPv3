<div class="p-4 @if ($numpage != 1) hidden @endif ">
    <div class="mt-2 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
        <x-form.input
            label="Product Name"
            type="text"
            name="Product.name"
            value=""
            mandatory=""
            disable="true"
            wire:model="Product.name"
        />
        <x-form.input-tag
            label="Profit Rate"
            type="text"
            name="Product.profit_rate"
            value=""
            leftTag=""
            rightTag="%"
            mandatory=""
            disable="true"
            wire:model="Product.profit_rate"
        />
    </div>
    <div class="mt-2 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
        <x-form.input-tag
            label="Amount of Financing Requested"
            type="text"
            name="Account.purchase_price"
            value=""
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable=""
            wire:model="Account.purchase_price"
        />
        <x-form.dropdown
            label="Financing Period Requested"
            value=""
            name="Account.duration"
            id="Account.duration"
            leftTag=""
            rightTag="Year"
            mandatory=""
            disable=""
            default="yes"
            wire:model="Account.duration"
            >
            @for ($i = $Product->term_min; $i <= $Product->term_max; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </x-form.dropdown>
    </div>
    <x-general.card class="p-4 mt-2 bg-white rounded-md shadow-md">
        <div class="p-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Customer Info </h2>

            <div class="mt-2 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input
                    label="Name"
                    type="text"
                    name="Customer.name"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Customer.name"
                />
                <x-form.input
                    label="IC Number"
                    type="text"
                    name="Customer.icno"
                    value=""
                    mandatory=""
                    disable="true"
                    wire:model="Customer.icno"
                />
            </div>

            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input
                    label="Birth Date"
                    type="text"
                    name="Customer.birthdate"
                    value=""
                    mandatory=""
                    disable="true"
                    wire:model="Customer.birthdate"
                />
                <x-form.input
                    label="Mobile Number"
                    type="text"
                    name="Customer.mobile_num"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Customer.mobile_num"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                <x-form.address class="mt-6"
                    label="Address"
                    mandatory=""
                    disable=""
                    name1="CustAddress.address1"
                    name2="CustAddress.address2"
                    name3="CustAddress.address3"
                    name4="CustAddress.town"
                    name5="CustAddress.postcode"
                    name6="CustAddress.def_state_id"
                    :state="$state"
                    condition="state"
                />
            </div>
            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-form.input
                    label="Email"
                    type="text"
                    name="Customer.email"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Customer.email"
                />

                <x-form.input
                    label="Membership Number"
                    type="text"
                    name="membership_no"
                    value=""
                    mandatory=""
                    disable="true"
                    wire:model=""
                />

                <x-form.dropdown
                    label="Gender"
                    value=""
                    name="Customer.gender_id"
                    id="Customer.gender_id"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Customer.gender_id"
                >
                    @foreach ($gender as $list)
                        <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                </x-form.dropdown>
            </div>
            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-form.dropdown
                    label="Race"
                    value=""
                    name="Customer.race_id"
                    id="Customer.race_id"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Customer.race_id"
                >
                @foreach ($race as $list)
                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                @endforeach
                </x-form.dropdown>

                <x-form.dropdown
                    label="Education"
                    value=""
                    name="Customer.education_id"
                    id="Customer.education_id"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Customer.education_id"
                >
                @foreach ($education as $list)
                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                @endforeach
                </x-form.dropdown>
                <x-form.dropdown
                    label="Marital"
                    value=""
                    name="Customer.marital_id"
                    id="Customer.marital_id"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Customer.marital_id"
                >
                @foreach ($marital as $list)
                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                @endforeach
                </x-form.dropdown>
            </div>
            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">

                <x-form.dropdown
                    label="Title"
                    value=""
                    name="Customer.title_id"
                    id="Customer.title_id"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Customer.title_id"
                >
                    @foreach ($title as $list)
                        <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                    </x-form.dropdown>
            </div>
        </div>
        <div class="p-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Family Info </h2>
            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.dropdown
                    label="Relationship"
                    value=""
                    name="Family.relationship_id"
                    id="Family.relationship_id"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Family.relationship_id"
                >
                @foreach ($relationship as $list)
                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                @endforeach
                </x-form.dropdown>
                <x-form.input
                    label="Name"
                    type="text"
                    name="CustFamily.name"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="CustFamily.name"
                />
            </div>
            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input
                    label="IC Number"
                    type="text"
                    name="CustFamily.icno"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="CustFamily.icno"
                />

                <x-form.input
                    label="Mobile Number"
                    type="text"
                    name="CustFamily.mobile_num"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="CustFamily.mobile_num"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                <x-form.address class="mt-6"
                    label="Address"
                    mandatory=""
                    disable=""
                    name1="FamilyAddress.address1"
                    name2="FamilyAddress.address2"
                    name3="FamilyAddress.address3"
                    name4="FamilyAddress.town"
                    name5="FamilyAddress.postcode"
                    name6="FamilyAddress.def_state_id"
                    :state="$state"
                    condition="state"
                />
            </div>
        </div>
        <div class="p-4">
             <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Employer Info </h2>
             <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input
                    label="Company Name"
                    name="Employer.name"
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model="Employer.name"
                />
                <x-form.input
                    label="Name Of Department"
                    type="text"
                    name="Employer.department"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Employer.department"
                />
            </div>
            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input
                    label="Position"
                    type="text"
                    name="Employer.position"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Employer.position"
                />
                <x-form.input
                    label="Office Telephone Number"
                    type="text"
                    name="Employer.office_num"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Employer.office_num"
                />
            </div>
            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input-tag
                    label="Salary"
                    type="text"
                    name="Employer.salary"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    wire:model="Employer.salary"
                />
                <x-form.input
                    label="Worker Number"
                    type="text"
                    name="Employer.worker_num"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Employer.worker_num"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                <x-form.address class="mt-6"
                    label="Address"
                    mandatory=""
                    disable=""
                    name1="EmployerAddress.address1"
                    name2="EmployerAddress.address2"
                    name3="EmployerAddress.address3"
                    name4="EmployerAddress.town"
                    name5="EmployerAddress.postcode"
                    name6="EmployerAddress.def_state_id"
                    :state="$state"
                    condition="state"
                />
            </div>
        </div>
        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <a href="{{ route('financing.list') }}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-none">
                    Cancel
                </a>
                <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Next
                </button>
            </div>
        </div>

    </x-general.card>
</div>