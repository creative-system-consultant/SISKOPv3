@isset($membership)
<div>
    <x-general.card class="px-4">
        <div class="pb-4 px-2"  x-data="{ active:0 }">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                <div class="p-4 mt-4 bg-white dark:bg-gray-700 rounded-md shadow-md">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Applicant Information - {{ $membership->id }}</h2>
                    <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-5 md:grid-cols-5 lg:grid-cols-5">
                        <x-form.input
                            label="Name"
                            name="custname"
                            value="{{ $membership->customer->name ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                        <x-form.input
                            label="Identity Number"
                            name="custic"
                            value="{{ $membership->customer->icno ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                        <x-form.input
                            label="Email"
                            name="custic"
                            value="{{ $membership->customer->email ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                        <x-form.input
                            label="Birthdate"
                            name="custic"
                            value="{{ $membership->customer->birthdate ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                        <x-form.input
                            label="Registration Fee"
                            name="custic"
                            value="{{ $membership->register_fee ?? '' }}"
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
                    <x-heroicon-o-user-circle class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                        Personal Detail
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="1">
                    <x-heroicon-o-home class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                        Addresses
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="2">
                    <x-heroicon-o-user-group class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                        Beneficiary
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="3">
                    <x-heroicon-o-briefcase class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Employment
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="4">
                    <x-heroicon-o-building-office class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Introducer
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="5">
                    <x-heroicon-o-credit-card class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Deduction & Payment
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="6">
                    <x-heroicon-o-document class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Document Verification
                    </span>
                </x-hovertab.title>
                <x-hovertab.title name="7">
                    <x-heroicon-o-check-circle class="w-6 h-6 " />
                    <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                        Approval
                    </span>
                </x-hovertab.title>
            </div>

            <!-- Personal Detail -->
            <div x-show="active == 7">
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Customer Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                        <div>
                            <x-form.dropdown
                                label="Title"
                                value=""
                                name="Cust.title_id"
                                id=""
                                mandatory=""
                                disable="true"
                                default="yes"
                            >
                                {{-- @foreach ($title_id as $list)
                                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                                @endforeach --}}
                            </x-form.dropdown>
                        </div>
                        <div>
                            <x-form.input
                                label="Full Name"
                                name="Cust.name"
                                value="{{ $Cust->name }}"
                                mandatory=""
                                disable="true"
                                type="text"
                            />
                        </div>
                        <div>
                            <x-form.input
                                label="IC Number"
                                name="Cust.icno"
                                value="{{ $Cust->identity_no }}"
                                mandatory=""
                                disable="true"
                                type="text"
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
                            />
                        </div>
                        <div>
                            <x-form.input
                                label="Mobile Number"
                                name="Cust.mobile_num"
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model="Cust.mobile_num"
                            /> 
                        </div>
                        <div>
                            <x-form.input
                                label="Email"
                                name="Cust.email"
                                value=""
                                mandatory=""
                                disable="true"
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
                                disable="true"
                                default="yes"
                                wire:model="Cust.race_id"
                            >
                                {{-- @foreach ($race_id as $list)
                                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                                @endforeach --}}
                            </x-form.dropdown>
                        </div>
                        <div>
                            <x-form.dropdown
                                label="Gender"
                                value=""
                                name="Cust.gender_id"
                                id=""
                                mandatory=""
                                disable="true"
                                default="yes"
                                wire:model="Cust.gender_id"
                            >
                                {{-- @foreach ($gender_id as $list)
                                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                                @endforeach --}}
                            </x-form.dropdown>
                        </div>
                        <div>
                            <x-form.input
                                label="Age"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model=""
                            />
                        </div>
                        <div>
                            <x-form.dropdown
                                label="Education"
                                value=""
                                name="Cust.education_id"
                                id=""
                                mandatory=""
                                disable="true"
                                default="yes"
                                wire:model="Cust.education_id"
                            >
                                {{-- @foreach ($education_id as $list)
                                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                                @endforeach --}}
                            </x-form.dropdown>
                        </div>
                        <div>
                            <x-form.dropdown
                                label="Marital"
                                value=""
                                name="Cust.marital_id"
                                id=""
                                mandatory=""
                                disable="true"
                                default="yes"
                                wire:model="Cust.marital_id"
                            >
                                {{-- @foreach ($marital_id as $list)
                                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                                @endforeach --}}
                            </x-form.dropdown>
                        </div>
                        <div >
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

            <!-- Addresses -->
            <div x-show="active == 1">
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Address Details</h2>
                    <div class="grid grid-cols-1 mt-4 gap-2">
                        <div>
                            <x-form.address class="mt-2"
                                label="Home Address"
                                mandatory=""
                                disable="true"
                                name1="CustAddress.address1"
                                name2="CustAddress.address2"
                                name3="CustAddress.address3"
                                name4="CustAddress.town"
                                name5="CustAddress.postcode"
                                name6="CustAddress.state_id"
                                name7=""
                                {{-- :state="$state_id" --}}
                                condition="state"
                                mailFlag="true"
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-4 gap-2">
                        <div>
                            <x-form.address class="mt-2"
                                label="Office Address"
                                mandatory=""
                                disable="true"
                                name1="EmployAddress.address1"
                                name2="EmployAddress.address2"
                                name3="EmployAddress.address3"
                                name4="EmployAddress.town"
                                name5="EmployAddress.postcode"
                                name6="EmployAddress.state_id"
                                name7=""
                                {{-- :state="$state_id" --}}
                                condition="state"
                                mailFlag="true"
                            /> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beneficiary -->
            <div x-show="active == 2">
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Family Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                        <div>
                            <x-form.input
                                label="Full Name"
                                name="CustFamily.name"
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model="CustFamily.name"
                            /> 
                        </div>
                        <div>
                            <x-form.input
                                label="Member No"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                        <div>
                            <x-form.input
                                label="Email"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                        <div>
                            <x-form.input
                                label="IC Number"
                                name="CustFamily.icno"
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model="CustFamily.icno"
                                wire:keyup="load_family"
                            />
                        </div>
                        <div>
                            <x-form.dropdown
                                label="Relationship"
                                value=""
                                name="Family.relationship_id"
                                id=""
                                mandatory=""
                                disable="true"
                                default="yes"
                                wire:model="Family.relationship_id"
                                wire:change="load_family"
                            >
                            {{-- @foreach ($relationship as $list)
                                <option value="{{ $list->id }}"> {{ $list->description }}</option>
                            @endforeach --}}
                            </x-form.dropdown>
                        </div>
                        <div>
                            <x-form.input
                                label="Mobile Number"
                                name="CustFamily.mobile_num"
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model="CustFamily.mobile_num"
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-4  gap-2">
                        <div>
                            <x-form.address class="mt-2"
                                label="Home Address"
                                mandatory=""
                                disable="true"
                                name1="FamilyAddress.address1"
                                name2="FamilyAddress.address2"
                                name3="FamilyAddress.address3"
                                name4="FamilyAddress.town"
                                name5="FamilyAddress.postcode"
                                name6="FamilyAddress.state_id"
                                name7=""
                                {{-- :state="$state_id" --}}
                                condition="state"
                                mailFlag="true"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employment -->
            <div x-show="active == 3">
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Work Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                        <div>
                            <x-form.input
                                label="Company Name"
                                name="Employer.name"
                                value=""
                                mandatory=""
                                disable="true"
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
                                disable="true"
                                type="text"
                                wire:model="Employer.department"
                            /> 
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-4 gap-2">
                        <div>
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
                        </div>
                        <div>
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
                        </div>
                        <div>
                            <x-form.input
                                label="Staff No"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                        <div>
                            <x-form.input
                                label="Start Work Date"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="date"
                                wire:model=""
                            /> 
                        </div>
                        <div>
                            <x-form.input
                                label="Position"
                                name="Employer.position"
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model="Employer.position"
                            /> 
                        </div>
                        <div>
                            <x-form.input
                                label="Office Telephone Number"
                                name="Employer.office_num"
                                value=""
                                mandatory=""
                                disable="true"
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
                                disable="true"
                                type="text"
                                wire:model="Employer.salary"
                            /> 
                        </div>
                        <div>
                            <x-form.input
                                label="Salary No"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                        <div>
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
                        </div>
                        <div>
                            <x-form.input
                                label="Work Phone"
                                name="Employer.worker_num"
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model="Employer.worker_num"
                            /> 
                        </div>
                        <div>
                            <x-form.input
                                label="Work Email"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
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
                                disable="true"
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
                                disable="true"
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
                                disable="true"
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Introducer -->
            <div x-show="active == 4">
                <div  class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Introducer Details </h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 mt-4">
                        <x-form.input
                            label="INTRODUCER NAME"
                            name="CustIntroducer.name"
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model="CustIntroducer.name"
                            readonly
                        />
                        <x-form.input
                            label="INTRODUCER IC NUMBER"
                            name="CustIntroducer.icno"
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model="CustIntroducer.icno"
                            readonly
                        />
                        <x-form.input
                            label="INTRODUCER EMAIL"
                            name="CustIntroducer.email"
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model="CustIntroducer.email"
                            readonly
                        />
                        <x-form.input
                            label="INTRODUCER MEMBERSHIP NUMBER"
                            name="CustIntroducer.mbr_no"
                            value=""
                            mandatory=""
                            disable="true"
                            type="text"
                            wire:model="CustIntroducer.mbr_no"
                            readonly
                        />
                    </div>
                </div>
            </div>

            <!--  Deduction & Payment -->
            <div x-show="active == 5">
                <!-- Deduction -->
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Deduction </h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4">
                        <div>
                            <x-form.input-tag
                                label="Member Fee (One-time only)"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                leftTag="RM"
                                rightTag=""
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                        <div>
                            <x-form.input-tag
                                label="Contribution (Minimum RM50)"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                leftTag="RM"
                                rightTag=""
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                        <div>
                            <x-form.input-tag
                                label="Share (Minimum RM500)"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                leftTag="RM"
                                rightTag=""
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                        <div>
                            <x-form.input-tag
                                label="Share (Minimum RM500)"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                leftTag="RM"
                                rightTag=""
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                        <div>
                            <x-form.dropdown
                                label="Type of Deduction Payment"
                                value=""
                                name=""
                                id=""
                                mandatory=""
                                disable="true"
                                default="yes"
                                wire:model=""
                            >
                            <option value=""></option>
                            </x-form.dropdown>
                        </div>
                        <div>
                            <x-form.input-tag
                                label="Total"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                leftTag="RM"
                                rightTag=""
                                type="text"
                                wire:model=""
                            /> 
                        </div>
                    </div>
                </div>

                <!-- Payment -->
                <div class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Payment </h2>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4">
                        <div>
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
                            <option value=""></option>
                            </x-form.dropdown>
                        </div>
                        <div>
                            <x-form.input
                                label="Member No."
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model=""
                            />
                        </div>
                        <div>
                            <x-form.input
                                label="Full Name"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model=""
                            />
                        </div>
                        <div>
                            <x-form.input
                                label="IC No"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model=""
                            />
                        </div>
                        <div>
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
                            <option value=""></option>
                            </x-form.dropdown>
                        </div>
                        <div>
                            <x-form.input
                                label="Autopay"
                                name=""
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model=""
                            />
                        </div>
                        <div>
                            <x-form.input
                                label="SI"
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
            </div>

            <!-- Document Verification -->
            <div x-show="active == 6">
                <div  class="py-4 mt-4">
                    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Document Details</h2>
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
                                    Copy of Staff ID Card
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
                                    Member Application (Signed)
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

            <!-- Approval -->
            <div>
                <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approvals</h2>
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="Done" sort="" />
                        <x-table.table-header class="text-left" value="Role" sort="" />
                        <x-table.table-header class="text-left" value="Approval By" sort="" />
                        <x-table.table-header class="text-left" value="Approval Type" sort="" />
                        <x-table.table-header class="text-left" value="Note" sort="" />
                        <x-table.table-header class="text-left" value="Date" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                    @foreach ($membership->approvals as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-left">
                                @if($item->order < $membership->step || $membership->flag > 1)
                                    <x-heroicon-o-check-circle class="w-6 h-6 text-green-500"/>
                                @elseif($item->order == $membership->step)
                                    <x-heroicon-o-play-circle class="w-6 h-6 text-blue-500"/>
                                @endif
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->rolegroup?->name }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->user?->name ?? "-" }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                @if(str_contains($item->type,'vote')) {{ $item->vote ?? "-" }} @else {{ $item->type ?? "-" }} @endif
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->note ?? "-" }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                @if($item->type == NULL || (str_contains($item->type,'vote') && $item->vote == NULL)) - @else {{ $item->updated_at->format('d-m-Y H:i a') }} @endif
                            </x-table.table-body>
                        </tr>
                    @endforeach
                    </x-slot>
                </x-table.table>
            </div>
        </div>

        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                @if($membership?->flag == 1)
                    <button wire:click="remake_approvals" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 border-2 rounded-md focus:outline-non">
                        RESET APPROVALS
                    </button>
                @endif
                <button @click="openModal = false" wire:click="clearApplication" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                    Close
                </button>
            </div>
        </div>
    </x-general.card>
</div>
@endisset