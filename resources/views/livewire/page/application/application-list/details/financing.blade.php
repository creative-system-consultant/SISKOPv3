@isset($financing)
<div>
    <x-general.card class="px-4">
        <div class="pb-4 px-2"  x-data="{ active:0 }">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <div class="p-4 mt-4 bg-white dark:bg-gray-700 rounded-md shadow-md">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Financing Information </h2>
                    <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                    <x-form.input
                        label="Product Name"
                        type="text"
                        name="cont_apply"
                        value="{{ $financing->product->name ?? '' }}"
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input-tag
                        label="Amount requested"
                        type="text"
                        name="cont_approved"
                        value="{{ $financing->purchase_price ?? '0.00' }}"
                        placeholder="0.00"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                    <x-form.input-tag
                        label="Term requested"
                        type="text"
                        name="cont_approved"
                        value="{{ $financing->duration ?? '0.00' }}"
                        placeholder="0.00"
                        leftTag=""
                        rightTag="MONTH"
                        mandatory=""
                        disable="true"
                    />
                    </div>
                </div>
                <div class="p-4 mt-4 bg-white dark:bg-gray-700 rounded-md shadow-md">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Applicant Information </h2>
                    <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                    <x-form.input
                        label="Name"
                        name=""
                        value="{{ $financing->customer->name ?? '' }}"
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input
                        label="Identity Number"
                        name=""
                        value="{{ $financing->customer->icno ?? '' }}"
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input
                        label="Birthdate"
                        type="date"
                        name=""
                        value="{{ $financing->customer->birthdate ?? '' }}"
                        mandatory=""
                        disable="true"
                    />
                    <x-form.input
                        label="Mobile Number"
                        type="text"
                        name=""
                        value="{{ $financing->customer->mobile_num ?? '' }}"
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    </div>
                </div>
            </div>

            <!-- tab list -->
            <div class="flex flex-wrap justify-start sm:justify-start bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-4 ">
                <x-hovertab.title name="0">
                    <x-heroicon-o-chart-pie class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                        Product Info
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="1">
                    <x-heroicon-o-user-circle class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                        Personal Detail
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="2">
                    <x-heroicon-o-home class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                        Addresses
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="3">
                    <x-heroicon-o-user-group class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                        Beneficiary
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="4">
                    <x-heroicon-o-briefcase class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                        Employment
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="5">
                    <x-heroicon-o-clipboard-document-list class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Guarantor
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="6">
                    <x-heroicon-o-clipboard-document class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Referrer
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="7">
                    <x-heroicon-o-clipboard-document-list class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Current Financing & Settlement
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="8">
                    <x-heroicon-o-document-check class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Credit Check
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="9">
                    <x-heroicon-o-calculator class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Charges & Payment
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="10">
                    <x-heroicon-o-document-text class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Document Verification
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="11">
                    <x-heroicon-o-check-circle class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Approval
                    </span>
                </x-hovertab.title>
            </div>

            <!-- Product info -->
            <div  x-show="active == 0">
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Product Info </h2>
                    <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <x-form.input
                            label="Product Name"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input
                            label="Product Type"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Apply Amount"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Profit Rate"
                            type="text"
                            name=""
                            value=""
                            leftTag=""
                            rightTag="%"
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.dropdown
                            label="Period (Month)"
                            value=""
                            name=""
                            id=""
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model=""
                        >
                            {{-- @foreach ($title as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.dropdown
                            label="Panel / Brand"
                            value=""
                            name=""
                            id=""
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model=""
                        >
                            {{-- @foreach ($title as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.dropdown
                            label="Goods Type"
                            value=""
                            name=""
                            id=""
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model=""
                        >
                            {{-- @foreach ($title as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.input
                            label="Purpose (Please state your purpose)"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Selling Price"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Profit Amount"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Monthly Instalment"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />

                    </div>
                </div>
            </div>

            <!-- Personal Detail -->
            <div x-show="active == 1">
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Customer Info </h2>
                    <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <x-form.dropdown
                            label="Title"
                            value=""
                            name="Customer.title_id"
                            id="Customer.title_id"
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model="Customer.title_id"
                        >
                            {{-- @foreach ($title as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.input
                            label="Name"
                            type="text"
                            name="Customer.name"
                            value=""
                            mandatory=""
                            disable="true"
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
                            disable="true"
                            wire:model="Customer.mobile_num"
                        />
                        <x-form.input
                            label="Email"
                            type="text"
                            name="Customer.email"
                            value=""
                            mandatory=""
                            disable="true"
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
                        <x-form.input
                            label="Age"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model=""
                        />
                        <x-form.dropdown
                            label="Gender"
                            value=""
                            name="Customer.gender_id"
                            id="Customer.gender_id"
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model="Customer.gender_id"
                        >
                            {{-- @foreach ($gender as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.dropdown
                            label="Race"
                            value=""
                            name="Customer.race_id"
                            id="Customer.race_id"
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model="Customer.race_id"
                        >
                            {{-- @foreach ($race as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.dropdown
                            label="Education"
                            value=""
                            name="Customer.education_id"
                            id="Customer.education_id"
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model="Customer.education_id"
                        >
                            {{-- @foreach ($education as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.dropdown
                            label="Marital"
                            value=""
                            name="Customer.marital_id"
                            id="Customer.marital_id"
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model="Customer.marital_id"
                        >
                            {{-- @foreach ($marital as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <div>
                            <x-form.dropdown
                                label="No. of Dependent"
                                value=""
                                name=""
                                id=""
                                mandatory=""
                                disable="true"
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

            <!--  Addresses -->
            <div x-show="active == 2">
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Address Info </h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
                        <x-form.address
                            label="Home Address"
                            mandatory=""
                            disable="true"
                            name1="CustAddress.address1"
                            name2="CustAddress.address2"
                            name3="CustAddress.address3"
                            name4="CustAddress.town"
                            name5="CustAddress.postcode"
                            name6="CustAddress.state_id"
                            {{-- :state="$state" --}}
                            condition="state"
                            mailFlag="true"
                        />
                    </div>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 mt-4">
                        <x-form.address
                            label="Office Address"
                            mandatory=""
                            disable="true"
                            name1="EmployerAddress.address1"
                            name2="EmployerAddress.address2"
                            name3="EmployerAddress.address3"
                            name4="EmployerAddress.town"
                            name5="EmployerAddress.postcode"
                            name6="EmployerAddress.state_id"
                            {{-- :state="$state" --}}
                            condition="state"
                            mailFlag="true"
                        />
                    </div>
                </div>
            </div>

            <!-- Beneficiary -->
            <div x-show="active == 3">
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Family Info </h2>
                    <div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 ">
                        <x-form.input
                            label="Name"
                            type="text"
                            name="CustFamily.name"
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model="CustFamily.name"
                        />
                        <x-form.input
                            label="IC Number"
                            type="text"
                            name="CustFamily.icno"
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model="CustFamily.icno"
                        />
                        <x-form.input
                            label="Mobile Number"
                            type="text"
                            name="CustFamily.mobile_num"
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model="CustFamily.mobile_num"
                        />
                        <x-form.input
                            label="Member No"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input
                            label="Email"
                            type="text"
                            name="CustFamily.name"
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model="CustFamily.name"
                        />
                        <x-form.dropdown
                            label="Relationship"
                            value=""
                            name="Family.relationship_id"
                            id="Family.relationship_id"
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model="Family.relationship_id"
                        >
                            {{-- @foreach ($relationship as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                    </div>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
                        <x-form.address class="mt-6"
                            label="Address"
                            mandatory=""
                            disable="true"
                            name1="FamilyAddress.address1"
                            name2="FamilyAddress.address2"
                            name3="FamilyAddress.address3"
                            name4="FamilyAddress.town"
                            name5="FamilyAddress.postcode"
                            name6="FamilyAddress.state_id"
                            {{-- :state="$state" --}}
                            condition="state"
                            mailFlag="true"
                        />
                    </div>
                </div>
            </div>

            <!-- Employment -->
            <div  x-show="active == 4">
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Employer Info </h2>
                    <div  class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                        <x-form.input
                            label="Company Name"
                            name="Employer.name"
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model="Employer.name"
                        />
                        <x-form.input
                            label="Name Of Department"
                            type="text"
                            name="Employer.department"
                            value=""
                            mandatory=""
                            disable="true"
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
                            disable="true"
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
                            disable="true"
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
                            disable="true"
                            type="text"
                            wire:model=""
                        /> 
                        <x-form.input
                            label="Start Work Date"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="date"
                            wire:model=""
                        /> 
                        <x-form.input
                            label="Position"
                            type="text"
                            name="Employer.position"
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model="Employer.position"
                        />
                        <x-form.input
                            label="Office Telephone Number"
                            type="text"
                            name="Employer.office_num"
                            value=""
                            mandatory=""
                            disable="true"
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
                            disable="true"
                            wire:model="Employer.salary"
                        />
                        <x-form.input
                            label="Salary No"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
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
                            disable="true"
                            type="text"
                            wire:model=""
                        /> 
                        <x-form.input
                            label="Work Phone"
                            type="text"
                            name="Employer.worker_num"
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model="Employer.worker_num"
                        />
                        <x-form.input
                            label="Work Email"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model=""
                        /> 
                        <x-form.input
                            label="Extension"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model=""
                        /> 
                        <x-form.input
                            label="Start Pension Date"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="date"
                            wire:model=""
                        /> 
                        <x-form.input
                            label="Start Pension Age "
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model=""
                        /> 
                    </div>
                </div>
            </div>

            <!-- Guarantor -->
            <div  x-show="active == 5">
                <div  class="px-6 py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Guarantor </h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 mt-4">
                        <x-form.input
                            label="Guarantor NAME"
                            name="Guarantor.name"
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model="Guarantor.name"
                            readonly
                        />
                        <x-form.input
                            label="Guarantor IC NUMBER"
                            name="Guarantor.icno"
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model="Guarantor.icno"
                            readonly
                        />
                        <x-form.input
                            label="Guarantor EMAIL"
                            name="Guarantor.email"
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model="Guarantor.email"
                            readonly
                        />
                        <x-form.input
                            label="Guarantor MEMBERSHIP NUMBER"
                            name="Guarantor.mbr_no"
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model="Guarantor.mbr_no"
                            readonly
                        />
                        <x-form.dropdown
                            label="Guarantor RELATIONSHIP"
                            value=""
                            name=""
                            id=""
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model=""
                            wire:change=""
                        >
                        {{-- @foreach ($relationship as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach --}}
                        </x-form.dropdown>
                    </div>
                    <div class="grid grid-cols-1 gap-2 mt-4">
                        <x-form.address class="mt-2"
                            label="Guarantor ADDRESS"
                            mandatory=""
                            disable="true"
                            name1=""
                            name2=""
                            name3=""
                            name4=""
                            name5=""
                            name6=""
                            {{-- :state="" --}}
                            condition="state"
                        /> 
                    </div>
                </div>
            </div>

            <!-- Referrer -->
            <div  x-show="active == 6">
                <div  class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Referrer </h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 mt-4">
                        <x-form.input
                            label="Referrer NAME"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model=""
                            readonly
                        />
                        <x-form.input
                            label="Referrer IC NUMBER"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model=""
                            readonly
                        />
                        <x-form.input
                            label="Referrer EMAIL"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model=""
                            readonly
                        />
                        <x-form.input
                            label="Referrer MEMBERSHIP NUMBER"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model=""
                            readonly
                        />
                        <x-form.dropdown
                            label="Referrer RELATIONSHIP"
                            value=""
                            name=""
                            id=""
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model=""
                            wire:change=""
                        >
                        {{-- @foreach ($relationship as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach --}}
                        </x-form.dropdown>
                    </div>
                    <div class="grid grid-cols-1 gap-2 mt-4">
                        <x-form.address class="mt-2"
                            label="Referrer ADDRESS"
                            mandatory=""
                            disable="true"
                            name1=""
                            name2=""
                            name3=""
                            name4=""
                            name5=""
                            name6=""
                            {{-- :state="" --}}
                            condition="state"
                        /> 
                    </div>
                </div>
            </div>

            <!-- Current Financing & Settlement -->
            <div  x-show="active == 7">
                <div  class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Current Financing </h2>
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="No" sort="" />
                            <x-table.table-header class="text-left" value="Account Number" sort="" />
                            <x-table.table-header class="text-left" value="Product" sort="" />
                            <x-table.table-header class="text-left" value="Final Instalment Date" sort="" />
                            <x-table.table-header class="text-left" value="Monthly Instalmen" sort="" />
                            <x-table.table-header class="text-left" value="Amount Arrears" sort="" />
                            <x-table.table-header class="text-left" value="Balance Outstanding" sort="" />
                            <x-table.table-header class="text-left" value="Principal Outstanding" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                            </tr>
                        </x-slot>
                    </x-table.table>
                </div>
                <div  class="py-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Settlement </h2>
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="No" sort="" />
                            <x-table.table-header class="text-left" value="Account Type" sort="" />
                            <x-table.table-header class="text-left" value="Account Number" sort="" />
                            <x-table.table-header class="text-left" value="Profit Settlement" sort="" />
                            <x-table.table-header class="text-left" value="Principal Outstanding" sort="" />
                            <x-table.table-header class="text-left" value="Rebate" sort="" />
                            <x-table.table-header class="text-left" value="Settlement Balance" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                
                                </x-table.table-body>
                            </tr>
                        </x-slot>
                    </x-table.table>
                </div>
            </div>

            <!-- Credit Check -->
            <div  x-show="active == 8">
                <div  class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Income</h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <x-form.input-tag
                            label="Basic Salary"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Net Salary"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Allowance"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Other Income"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                    </div>
                </div>
                <div  class="py-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Account</h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <x-form.input-tag
                            label="Total Share"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Total Contribution"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Total Dividend"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                    </div>
                </div>
                <div  class="py-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Deduction</h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <x-form.input-tag
                            label="Monthly Share (If related)"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Monthly Contribution"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Monthly CCRIS"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Monthly Takaful Insurance"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Total Monthly Current Financing"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Other Deduction"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Account Settlement"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Monthly Instalment"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="New Monthly Deduction"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.dropdown
                            label="Autopay Allowed"
                            value=""
                            name=""
                            id=""
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model=""
                        >
                            {{-- @foreach ($title as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.input-tag
                            label="Total Deduction"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                    </div>
                </div>
                <div  class="py-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Eligibility</h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <x-form.input-tag
                            label="Eligible Balance"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.dropdown
                            label="Credit Score"
                            value=""
                            name=""
                            id=""
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model=""
                        >
                            {{-- @foreach ($title as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.input-tag
                            label="DSR %"
                            type="text"
                            name=""
                            value=""
                            leftTag=""
                            rightTag="%"
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                    </div>
                </div>
            </div>

            <!-- Charges & Payment  -->
            <div  x-show="active == 9">
                <div  class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Charges - Cooperative</h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <x-form.input-tag
                            label="Process Charge"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Share Sufficiency"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Stamp Duty"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Takaful Insurance (If related)"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Total Charges"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                    </div>
                </div>
                <div  class="py-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Charges - Additional</h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <x-form.input-tag
                            label="Advance Payment"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="SPeKAR + CCRIS Charge"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Goods Charge"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input-tag
                            label="Total Charges"
                            type="text"
                            name=""
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                    </div>
                </div>
                <div  class="py-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Payment</h2>
                    <div class="flex items-center justify-end">
                        <button class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-orange-500 border-2 rounded-md focus:outline-non">
                            Print Quotation
                        </button>
                    </div>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <x-form.dropdown
                            label="Payment Made by"
                            value=""
                            name=""
                            id=""
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model=""
                        >
                            {{-- @foreach ($title as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.input
                            label="Member No."
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input
                            label="Full Name"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input
                            label="IC No"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.dropdown
                            label="Payment Type"
                            value=""
                            name=""
                            id=""
                            mandatory=""
                            disable="true"
                            default="yes"
                            wire:model=""
                        >
                            {{-- @foreach ($title as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                        </x-form.dropdown>
                        <x-form.input
                            label="Autopay"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input
                            label="SI"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input
                            label="Total Final Deduction"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                        <x-form.input
                            label="Financing Balance"
                            type="text"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            wire:model=""
                        />
                    </div>
                </div>
            </div>

            <!-- Document Verification -->
            <div  x-show="active == 10">
                <div class="grid grid-cols-2 gap-4">
                    <div  class="py-4 mt-4">
                        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Document Members</h2>
                        <x-table.table>
                            <x-slot name="thead">
                                <x-table.table-header class="text-left" value="Doc" sort="" />
                                <x-table.table-header class="text-left" value="upload" sort="" />
                                <x-table.table-header class="text-left" value="action" sort="" />
                            </x-slot>
                            <x-slot name="tbody">
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        Copy of IC (Front & Back)
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        Copy of 3 Months Payslip
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        Employer Verification
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        Copy of IC Guarantor (Front & Back)
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        Copy of Guarantor 3 Months Payslip
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        Other documents
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                            </x-slot>
                        </x-table.table>
                    </div>
                    <div  class="py-4 mt-4">
                        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Document Office Used Only</h2>
                        <x-table.table>
                            <x-slot name="thead">
                                <x-table.table-header class="text-left" value="Doc" sort="" />
                                <x-table.table-header class="text-left" value="upload" sort="" />
                                <x-table.table-header class="text-left" value="action" sort="" />
                            </x-slot>
                            <x-slot name="tbody">
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        SPeKAR
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        CTOS
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        CCIRS
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left ">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        RAMCI
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                                <tr>
                                    <x-table.table-body colspan="" class="text-left text-xs">
                                        Other documents
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <x-form.input
                                            label=""
                                            type="text"
                                            name=""
                                            value=""
                                            mandatory=""
                                            disable=""
                                            type="file"
                                            wire:model=""
                                        />
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <a href="" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-400">
                                            <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                            Show
                                        </a>
                                    </x-table.table-body>
                                </tr>
                            </x-slot>
                        </x-table.table>
                    </div>
                </div>
            </div>

            <!-- Approvals List -->
            <div x-show="active == 11">
                <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approvals</h2>
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="Status" sort="" />
                        <x-table.table-header class="text-left" value="Approval By" sort="" />
                        <x-table.table-header class="text-left" value="Role" sort="" />
                        <x-table.table-header class="text-left" value="Approval" sort="" />
                        <x-table.table-header class="text-left" value="Note" sort="" />
                        <x-table.table-header class="text-left" value="Date" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                    @foreach ($financing->approvals()->orderby('order')->get() as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-left">
                                @if($item->order < $financing->step)
                                    <x-heroicon-o-check-circle class="w-6 h-6"/>
                                @elseif($item->order == $financing->step)
                                    <x-heroicon-o-play-circle class="w-6 h-6"/>
                                @endif
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->user?->name ?? "-" }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->rolegroup?->name }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                @if(str_contains($item->type,'vote')) {{ $item->vote ?? "-" }} @else {{ $item->type ?? "-" }} @endif
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->note ?? "-" }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                @if($item->type == NULL || (str_contains($item->type,'vote') && $item->vote == NULL)) - @else {{ $item->updated_at }} @endif
                            </x-table.table-body>
                        </tr>
                    @endforeach
                    </x-slot>
                </x-table.table>

                <div class="grid grid-cols-1 my-4 pb-4">
                    <x-form.text-area
                        label="Remark"
                        value=""
                        name=""
                        rows=""
                        placeholder="Place Holder"
                        disable=""
                        mandatory=""
                    />
                </div>
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <div  x-show="active !== 11">
                        <button @click="openModal = false" wire:click="closeApplication" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                            Close
                        </button>
                    </div>
                    <div class="flex items-center justify-center space-x-2"  x-show="active == 11">
                        <button class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                            Decline
                        </button>
                        <button class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 border-2 rounded-md focus:outline-non">
                            Qualify
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
@endisset