<div class="@if ($numpage != 1) hidden @endif">
<h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Customer Details</h2>

    <div class="mt-4 container mx-auto">
      <div @if ($member->field_status(2) == '0') style="display: none" @endif >
        <div class="p-4 mt-8 text-green-900 bg-green-200">
            <p><x-form.input 
                label="Full Name" 
                name="Cust.name" 
                value="" 
                mandatory=""
                disable=""
                type="text"
                wire:model="Cust.name"
            />  </p>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mt-50 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3"> 
        <div @if ($member->field_status(3) == '0') style="display: none" @endif >
             <div class="p-4 text-green-900 bg-green-200">
            <p><x-form.input 
                label="IC Number" 
                name="Cust.icno" 
                value="" 
                mandatory=""
                disable="true"
                type="text"
                wire:model="Cust.icno"
            />  </p>
        </div>
        </div>
        <div @if ($member->field_status(5) == '0') style="display: none" @endif >
            <div class="p-4 text-green-900 bg-green-200">
            <p><x-form.input 
                label="Birth Date" 
                name="birthdate" 
                value="{{ $Cust->birthdate->format('Y-m-d') }}" 
                mandatory=""
                disable=""
                type="date"
                wire:model="birthdate"
            />  </p>
            </div>
        </div>

       <div @if ($member->field_status(7) == '0') style="display: none" @endif >
        <div class="p-4 text-green-900 bg-green-200">
            <p><x-form.input 
                label="Mobile Number" 
                name="Cust.mobile_num" 
                value="" 
                mandatory=""
                disable="true"
                type="text"
                wire:model="Cust.mobile_num"
            />  </p>
        </div>
   </div>
</div>

    <div @if ($member->field_status(13) == '0') style="display: none" @endif >
        <div class="p-4 text-green-900 bg-green-200">
            <p><x-form.address class="mt-2"
                label="Home Address"
                mandatory=""
                disable=""
                name1="CustAddress.address1"
                name2="CustAddress.address2"
                name3="CustAddress.address3"
                name4="CustAddress.town"
                name5="CustAddress.postcode"
                name6="CustAddress.def_state_id"
                :state="$state_id"
                condition="state"
            />  
        </p>
        </div>
    </div>

<div class="grid grid-cols-1 gap-6 mt-50 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3"> 
    <div @if ($member->field_status(8) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
            <p><x-form.input 
                label="Email" 
                name="Cust.email" 
                value="" 
                mandatory=""
                disable=""
                type="text"
                wire:model="Cust.email"
            />  </p>
        </div>
    </div>
 
        <div @if ($member->field_status(11) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
            <p><x-form.dropdown 
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
            </x-form.dropdown></p>
        </div>
        </div>

    <div @if ($member->field_status(9) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
           <p><x-form.dropdown 
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
           </x-form.dropdown></p>
        </div>
       </div>

       <div @if ($member->field_status(12) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
           <p><x-form.dropdown 
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
           </x-form.dropdown></p>
        </div>
       </div>

       <div @if ($member->field_status(10) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
           <p><x-form.dropdown 
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
           </x-form.dropdown></p>
        </div>
       </div>

       <div @if ($member->field_status(1) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
           <p><x-form.dropdown 
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
           </x-form.dropdown></p>
        </div>
       </div>
</div>


<br><h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Family Details</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2">
    <div @if ($member->field_status(10) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
           <p><x-form.dropdown 
               label="Relationship"
               value=""
               name="Family.relationship_id" 
               id=""
               mandatory=""
               disable=""
               default="yes"  
               wire:model="Family.relationship_id"
           >
           @foreach ($relationship as $list)
           <option value="{{ $list->id }}"> {{ $list->description }}</option>
           @endforeach
           </x-form.dropdown></p>
        </div>
       </div>
    <div @if ($member->field_status(14) == '0') style="display: none" @endif >
      <div class="p-4 mt-2 text-green-900 bg-green-200">
          <p><x-form.input 
              label="Full Name" 
              name="CustFamily.name" 
              value="" 
              mandatory=""
              disable=""
              type="text"
              wire:model="CustFamily.name"
          />  </p>
      </div>
    </div>
  </div>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2">
    <div @if ($member->field_status(15) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
            <p><x-form.input 
                label="IC Number" 
                name="CustFamily.icno" 
                value="" 
                mandatory=""
                disable=""
                type="text"
                wire:model="CustFamily.icno"
            />  </p>
        </div>
      </div>
      <div @if ($member->field_status(16) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
            <p><x-form.input 
                label="Email" 
                name="CustFamily.email" 
                value="" 
                mandatory=""
                disable=""
                type="text"
                wire:model="CustFamily.email"
            />  </p>
        </div>
      </div>
      <div @if ($member->field_status(17) == '0') style="display: none" @endif >
        <div class="p-4 text-green-900 bg-green-200">
            <p><x-form.input 
                label="Mobile Number" 
                name="CustFamily.mobile_num" 
                value="" 
                mandatory=""
                disable=""
                type="text"
                wire:model="CustFamily.mobile_num"
            />  </p>
        </div>
      </div>
    
</div>
    <div @if ($member->field_status(18) == '0') style="display: none" @endif >
        <div class="p-4 text-green-900 bg-green-200">
            <p><x-form.address class="mt-2"
                label="Home Address"
                mandatory=""
                disable=""
                name1="FamilyAddress.address1"
                name2="FamilyAddress.address2"
                name3="FamilyAddress.address3"
                name4="FamilyAddress.town"
                name5="FamilyAddress.postcode"
                name6="FamilyAddress.def_state_id"
                :state="$state_id"
                condition="state"
            />  </p>
        </div>
    </div>
<br><h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Work Details</h2>
<div class="mt-8 container mx-auto">
    <div @if ($member->field_status(19) == '0') style="display: none" @endif >
      <div class="p-4 mt-2 text-green-900 bg-green-200">
          <p><x-form.input 
              label="Company Name" 
              name="Employer.name" 
              value="" 
              mandatory=""
              disable=""
              type="text"
              wire:model="Employer.name"
          />  </p>
      </div>
    </div>
  </div>
  <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2">
    <div @if ($member->field_status(20) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
            <p><x-form.input 
                label="Name Of Department" 
                name="Employer.department" 
                value="" 
                mandatory=""
                disable=""
                type="text"
                wire:model="Employer.department"
            />  </p>
        </div>
      </div>
      <div @if ($member->field_status(21) == '0') style="display: none" @endif >
        <div class="p-4 mt-2 text-green-900 bg-green-200">
            <p><x-form.input 
                label="Position" 
                name="Employer.position" 
                value="" 
                mandatory=""
                disable=""
                type="text"
                wire:model="Employer.position"
            />  </p>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
        <div @if ($member->field_status(22) == '0') style="display: none" @endif >
            <div class="p-4 mt-2 text-green-900 bg-green-200">
                <p><x-form.input 
                    label="Office Telephone Number" 
                    name="Employer.office_num" 
                    value="" 
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model="Employer.office_num"
                />  </p>
            </div>
        </div>
        <div @if ($member->field_status(23) == '0') style="display: none" @endif >
            <div class="p-4 mt-2 text-green-900 bg-green-200">
                <p><x-form.input-tag 
                    label="Salary" 
                    name="Employer.salary" 
                    value="" 
                    mandatory=""
                    leftTag="RM"
                    rightTag=""
                    disable=""
                    type="text"
                    wire:model="Employer.salary"
                />  </p>
            </div>
        </div>
        <div @if ($member->field_status(24) == '0') style="display: none" @endif >
            <div class="p-4 mt-2 text-green-900 bg-green-200">
                <p><x-form.input 
                    label="Worker Number" 
                    name="Employer.worker_num" 
                    value="" 
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model="Employer.worker_num"
                />  </p>
            </div>
        </div>
    </div>

        <div @if ($member->field_status(25) == '0') style="display: none" @endif >
            <div class="p-4 text-green-900 bg-green-200">
                <p><x-form.address class="mt-2"
                    label="Office Address"
                    mandatory=""
                    disable=""
                    name1="EmployAddress.address1"
                    name2="EmployAddress.address2"
                    name3="EmployAddress.address3"
                    name4="EmployAddress.town"
                    name5="EmployAddress.postcode"
                    name6="EmployAddress.def_state_id"
                    :state="$state_id"
                    condition="state"
                />  </p>
            </div>
        </div>

  <div class="p-4 mt-6 rounded-md bg-gray-50">
    <div class="flex items-center justify-center space-x-2">

        <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
            previous
        </button>
        
        <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
            Next
        </button>

        
        
    </div>
</div>

</div>
