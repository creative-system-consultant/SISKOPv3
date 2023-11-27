
    <! -- product Info -->
    <div  x-show="active == 0">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Product Info </h2>
            <div class="mt-2 grid grid-cols-1 gap-2 md:grid-cols-2 lg:grid-cols-4">
                <x-form.input
                    label="Product Name"
                    type="text"
                    name="Product.name"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Product.name"
                />
                <x-form.input
                    label="Apply Amount"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    wire:model=""
                />
                <x-form.input-tag
                    label="Profit Rate"
                    type="text"
                    name="Product.profit_rate"
                    value=""
                    leftTag=""
                    rightTag="%"
                    mandatory=""
                    disable=""
                    wire:model="Product.profit_rate"
                />
                <x-form.dropdown
                    label="Period (Month)"
                    value=""
                    name=""
                    id=""
                    leftTag=""
                    rightTag=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                    >
                    <option value=""></option>
                </x-form.dropdown>
                <x-form.dropdown
                    label="Panel / Brand"
                    value=""
                    name=""
                    id=""
                    leftTag=""
                    rightTag=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                    >
                    <option value=""></option>
                </x-form.dropdown>
                <x-form.dropdown
                    label="Goods Type"
                    value=""
                    name=""
                    id=""
                    leftTag=""
                    rightTag=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                    >
                    <option value=""></option>
                </x-form.dropdown>
                <x-form.dropdown
                    label="Financing Type"
                    value=""
                    name=""
                    id=""
                    leftTag=""
                    rightTag=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                    >
                    <option value=""></option>
                </x-form.dropdown>
                <x-form.input
                    label="Purpose (Please state your purpose)"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    wire:model=""
                />
                <x-form.input-tag
                    label="Expected Monthly Instalment"
                    type="text"
                    name=""
                    value=""
                    leftTag=""
                    rightTag="%"
                    mandatory=""
                    disable=""
                    wire:model=""
                />
            </div>
        </div>
    </div>

    <!-- Customer Info -->
    <div x-show="active == 1">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Customer Info </h2>

            <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
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
                <x-form.input
                    label="Name"
                    type="text"
                    name="Customer.name"
                    value=""
                    mandatory="true"
                    disable=""
                    wire:model="Customer.name"
                />
                <x-form.input
                    label="IC Number"
                    type="text"
                    name="Customer.icno"
                    value=""
                    mandatory="true"
                    disable="true"
                    wire:model="Customer.icno"
                />
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
                    mandatory="true"
                    disable=""
                    wire:model="Customer.mobile_num"
                />
                <x-form.input
                    label="Email"
                    type="text"
                    name="Customer.email"
                    value=""
                    mandatory="true"
                    disable=""
                    wire:model="Customer.email"
                />

                <x-form.input
                    label="Membership Number"
                    type="text"
                    name="membership_no"
                    value=""
                    mandatory="true"
                    disable="true"
                    wire:model="Customer.ref_no"
                />

                <x-form.input
                    label="Age"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                />

                <x-form.dropdown
                    label="Gender"
                    value=""
                    name="Customer.gender_id"
                    id="Customer.gender_id"
                    mandatory="true"
                    disable=""
                    default="yes"
                    wire:model="Customer.gender_id"
                >
                    @foreach ($gender as $list)
                        <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                </x-form.dropdown>

                <x-form.dropdown
                    label="Race"
                    value=""
                    name="Customer.race_id"
                    id="Customer.race_id"
                    mandatory="true"
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
                    mandatory="true"
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
                    mandatory="true"
                    disable=""
                    default="yes"
                    wire:model="Customer.marital_id"
                >
                    @foreach ($marital as $list)
                        <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                </x-form.dropdown>
                <div>
                    <x-form.dropdown
                        label="No. of Dependent"
                        value=""
                        name=""
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model=""
                    >
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                        <option value="">5</option>
                        <option value="">6</option>
                        <option value="">7</option>
                        <option value="">8</option>
                        <option value="">9</option>
                        <option value="">10</option>
                        <option value="">More Than 10</option>
                    </x-form.dropdown>
                </div>
            </div>
        </div>
    </div>

    <!-- Address Info -->
    <div x-show="active == 2">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Address Info </h2>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
                <x-form.address
                    label="Home Address"
                    mandatory=""
                    disable=""
                    name1="CustAddress.address1"
                    name2="CustAddress.address2"
                    name3="CustAddress.address3"
                    name4="CustAddress.town"
                    name5="CustAddress.postcode"
                    name6="CustAddress.state_id"
                    :state="$state"
                    condition="state"
                    mailFlag="true"
                />
            </div>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 mt-4">
                <x-form.address
                    label="Office Address"
                    mandatory=""
                    disable=""
                    name1="EmployerAddress.address1"
                    name2="EmployerAddress.address2"
                    name3="EmployerAddress.address3"
                    name4="EmployerAddress.town"
                    name5="EmployerAddress.postcode"
                    name6="EmployerAddress.state_id"
                    :state="$state"
                    condition="state"
                    mailFlag="true"
                />
            </div>
        </div>
    </div>

    <!-- Family Info -->
    <div x-show="active == 3">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Family Info </h2>
            <div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 ">
                <x-form.input
                    label="Name"
                    type="text"
                    name="CustFamily.name"
                    value=""
                    mandatory="true"
                    disable=""
                    wire:model="CustFamily.name"
                />
                <x-form.input
                    label="IC Number"
                    type="text"
                    name="CustFamily.icno"
                    value=""
                    mandatory="true"
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
                <x-form.input
                    label="Member No"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    wire:model=""
                />
                <x-form.input
                    label="Email"
                    type="text"
                    name="CustFamily.name"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="CustFamily.name"
                />
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
            </div>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
                <x-form.address class="mt-6"
                    label="Address"
                    mandatory=""
                    disable=""
                    name1="FamilyAddress.address1"
                    name2="FamilyAddress.address2"
                    name3="FamilyAddress.address3"
                    name4="FamilyAddress.town"
                    name5="FamilyAddress.postcode"
                    name6="FamilyAddress.state_id"
                    :state="$state"
                    condition="state"
                    mailFlag="true"
                />
            </div>
        </div>
    </div>

    <!-- Employer Info -->
    <div  x-show="active == 4">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Employer Info </h2>
            <div  class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
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
            <div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4">
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
                <x-form.input
                    label="Staff No"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                /> 
                <x-form.input
                    label="Start Work Date"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="date"
                    wire:model=""
                /> 
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
                    label="Salary No"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                /> 
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
                <x-form.input
                    label="Work Phone"
                    type="text"
                    name="Employer.worker_num"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Employer.worker_num"
                />
                <x-form.input
                    label="Work Email"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                /> 
                <x-form.input
                    label="Extension"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                /> 
                <x-form.input
                    label="Start Pension Date"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="date"
                    wire:model=""
                /> 
                <x-form.input
                    label="Start Pension Age "
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                /> 
            </div>
        </div>
    </div>

    <div x-show="active == 0 || active == 1 || active == 2 || active == 3 || active == 4">
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
    </div>
