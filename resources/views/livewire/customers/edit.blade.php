<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">CUSTOMER > PROFILE</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-general.header-title title="Edit Profile" route="{{route('customer.search')}}"/>
        <x-form.basic-form wire:submit.prevent="submit('{{ $Cust->uuid }}')" class="p-4">
            <h2 class="mt-4 mb-6 text-base font-semibold border-b-2 border-gray-300">Basic Field</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Name"
                    type="text" 
                    name="name" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model="Cust.name"
                />
                <x-form.input 
                    label="IC Number"
                    type="text"
                    name="icno" 
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Cust.icno" 
                />
            </div>

            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Birth Date"
                    type="date"
                    name="birthdate"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Cust.birthdate" 
                /> 
                <x-form.input 
                    label="Birth Place"
                    type="text" 
                    name="birthplace"
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model="Cust.birthplace"  
                />
            </div>

            <div class="mt-4 grid grid-cols-1 gap-6 mt-50 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4"> 
                <x-form.dropdown 
                    label="Customer Title"
                    value="{{ $Cust->title_id }}"
                    name="title_id"
                    id="title_id"
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="Cust.title_id"
                >
                    @foreach ($title as $list)
                        <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                </x-form.dropdown>

                <x-form.dropdown 
                    label="Customer Education"
                    value=""
                    name="education_id" 
                    id="education_id"
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="Cust.education_id"
                >
                    @foreach ($education as $list)
                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                </x-form.dropdown>

                <x-form.dropdown 
                    label="Customer Gender"
                    value=""
                    name="gender_id" 
                    id="gender_id"
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="Cust.gender_id"
                >
                @foreach ($gender as $list)
                    <option value="{{ $list->id }}"> {{ $list->description }}</option>
                @endforeach
                </x-form.dropdown>

                <x-form.dropdown 
                    label="Customer Marital"
                    value=""
                    name="marital_id" 
                    id="marital_id"
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="Cust.marital_id"
                >
                    @foreach ($marital as $list)
                        <option value="{{ $list->id }}"> {{ $list->description,110 }}</option>
                    @endforeach

                </x-form.dropdown>

                <x-form.dropdown 
                    label="Customer Race"
                    value=""
                    name="race_id"  
                    id="race_id"
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="Cust.race_id"
                >
                    @foreach ($race as $list)
                        <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                </x-form.dropdown>

                <x-form.dropdown 
                    label="Customer Country"
                    value=""
                    name="country_id" 
                    id="country_id"
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="Cust.country_id"
                >
                    @foreach ($country as $list)
                        <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                </x-form.dropdown>

                {{-- <x-form.dropdown 
                    label="Customer Language"
                    value=""
                    name="language_id" 
                    id="language_id"
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="Cust.language_id"
                >
                    @foreach ($language as $list)
                        <option value="{{ $list->id }}"> {{ $list->description }}</option>
                    @endforeach
                </x-form.dropdown> --}}
            </div>

            <h2 class="mt-6 mb-6 text-base font-semibold border-b-2 border-gray-300">Additional Field</h2>
            <div class="grid grid-cols-12 gap-6">
            @foreach ($Coop->fields as $index => $list)
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-3 xl:col-span-3">
                    <x-form.input 
                        label="{{ $list->label }}"
                        type="{{ $list->inputType() }}" 
                        name="{{ $list->name }}" 
                        value="" 
                        mandatory=""
                        disable=""
                        wire:model="Fvalue.{{ $index }}"
                    />
                </div>
            @endforeach
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50">
                <div class="flex items-center justify-center space-x-2">
                    <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                        Cancel
                    </a>
                    <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Update
                    </button>
                </div>
            </div>
        </x-form.basic-form>
    </div>
</div>