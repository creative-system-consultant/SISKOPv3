<div class="p-4 @if ($numpage != 1) hidden @endif ">
    <x-general.card class="p-4 mt-2 bg-white rounded-md shadow-md">
        <div class="p-4"> 
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Customer Info </h2> 

            <div class="mt-2 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Name"
                    type="text" 
                    name="customer_name" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model="Customer.name"
                />      
                <x-form.input 
                    label="IC Number"
                    type="text"
                    name="customer_icno" 
                    value=""
                    mandatory=""
                    disable="true"
                    wire:model="Customer.icno" 
                /> 
            </div>

            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Birth Date"
                    type="date" 
                    name="customer_birthdate" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model="Customer.birthdate"
                />      
                <x-form.input 
                    label="Mobile Number"
                    type="text"
                    name="customer_mobile_num" 
                    value=""
                    mandatory=""
                    disable="true"
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
                    name="customer_email" 
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
                    name="customer_gender" 
                    id="customer_gender"
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
                    name="customer_race" 
                    id="customer_race"
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
                    name="customer_education" 
                    id="customer_education"
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
                    name="customer_marital" 
                    id="customer_marital"
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
                    name="customer_title" 
                    id="customer_title"
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
                    name="family_relationship" 
                    id="family_relationship"
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
                    name="family_name" 
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
                    name="family_icno" 
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="CustFamily.icno" 
                />

                <x-form.input 
                    label="Mobile Number"
                    type="text" 
                    name="family_mobile_num" 
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
             <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Company Name"
                    type="text" 
                    name="employer_company_name" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model=""
                />      
                <x-form.input 
                    label="Name Of Department"
                    type="text"
                    name="employer_department" 
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="" 
                /> 
            </div>
            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Position"
                    type="text" 
                    name="employer_position" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model=""
                />  
                <x-form.input 
                    label="Office Telephone Number"
                    type="text" 
                    name="employer_office_num" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model=""
                />     
            </div>
            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Salary"
                    type="text" 
                    name="employer_salary" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model=""
                />  
                <x-form.input 
                    label="Worker Number"
                    type="text" 
                    name="employer_worker_num" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model=""
                />     
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                <x-form.address class="mt-6"
                    label="Address"
                    mandatory=""
                    disable=""
                    name1="your_wire_model_address1"
                    name2="your_wire_model_address2"
                    name3="your_wire_model_address3"
                    name4="your_wire_model_town"
                    name5="your_wire_model_postcode"
                    name6="your_wire_model_state"
                    :state="$state"
                    condition="state"
                />
            </div>
        </div>
        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-none">
                    Cancel
                </a>
                <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Next
                </button>
            </div>
        </div>

    </x-general.card>
</div>