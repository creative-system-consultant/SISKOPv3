<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Profile</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-general.header-title title="Profile" route="{{route('searchcustomer')}}"/>       
        <x-form.basic-form wire:submit.prevent="submit('{{ $cust->id }}')" class="p-4">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Name"
                    type="text" 
                    name="name" 
                    value="{{ $cust->name }}" 
                    mandatory=""
                    disable=""
                    wire:model.defer="cust.name"
                />      
                @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        
                <x-form.input 
                    label="IC Number"
                    type="text"
                    name="icno" 
                    value="{{ $cust->icno }}"
                    mandatory=""
                    disable=""
                    wire:model.defer="cust.icno" 
                /> 
                @error('icno')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
        </div><br>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
            <x-form.input 
                label="Birth Date"
                type="date"
                name="birthdate"
                value="{{ $cust->birthdate }}"
                mandatory=""
                disable=""
                wire:model.defer="cust.birthdate" 
            /> 
            @error('birthdate')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
    
            <x-form.input 
                label="Birth Place"
                type="text" 
                name="birthplace"
                value="{{ $cust->birthplace }}" 
                mandatory=""
                disable=""
                wire:model.defer="cust.birthplace"  
            />      
            @error('birthplace')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            </div><br>

            <div class="grid grid-cols-1 gap-6 mt-50 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3"> 
                <x-form.dropdown 
                label="Customer Title"
                value="{{ $cust->title_id }}"
                name="title_id"
                id="title_id"
                mandatory=""
                disable=""
                default="yes"  
                wire:model.defer="cust.title_id"
                >
                @foreach ($title_id as $list)
                <option value="{{ $list->id }}"> {{ Str::upper(Str::limit($list->description,110)) }}</option>
                @endforeach
            
                 </x-form.dropdown>       
                <x-form.dropdown 
                label="Customer Education"
                value="{{ $cust->education_id }}"
                name="education_id" 
                id="education_id"
                mandatory=""
                disable=""
                default="yes"  
                wire:model.defer="cust.education_id"
                >
                @foreach ($education_id as $list)
                <option value="{{ $list->id }}"> {{ Str::upper(Str::limit($list->description,110)) }}</option>
                @endforeach
            
                </x-form.dropdown>
                <x-form.dropdown 
                label="Customer Gender"
                value="{{ $cust->gender_id }}"
                name="gender_id" 
                id="gender_id"
                mandatory=""
                disable=""
                default="yes"  
                wire:model.defer="cust.gender_id"
                >
                @foreach ($gender_id as $list)
                <option value="{{ $list->id }}"> {{ Str::upper(Str::limit($list->description,110)) }}</option>
                @endforeach
            
                </x-form.dropdown>
                <x-form.dropdown 
                label="Customer Marital"
                value="{{ $cust->marital_id }}"
                name="marital_id" 
                id="marital_id"
                mandatory=""
                disable=""
                default="yes"  
                wire:model.defer="cust.marital_id"
                >
                @foreach ($marital_id as $list)
                <option value="{{ $list->id }}"> {{ Str::upper(Str::limit($list->description,110)) }}</option>
                @endforeach
            
                </x-form.dropdown>
                <x-form.dropdown 
                label="Customer Race"
                value="{{ $cust->race_id }}"
                name="race_id"  
                id="race_id"
                mandatory=""
                disable=""
                default="yes"  
                wire:model.defer="cust.race_id"
                >
                @foreach ($race_id as $list)
                <option value="{{ $list->id }}"> {{ Str::upper(Str::limit($list->description,110)) }}</option>
                @endforeach
            
                </x-form.dropdown>

                <x-form.dropdown 
                label="Customer Country"
                value="{{ $cust->country_id }}"
                name="country_id" 
                id="country_id"
                mandatory=""
                disable=""
                default="yes"  
                wire:model.defer="cust.country_id"
                >
                @foreach ($country_id as $list)
                <option value="{{ $list->id }}"> {{ Str::upper(Str::limit($list->description,110)) }}</option>
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
                wire:model.defer="cust.language_id"
                >
                @foreach ($language_id as $list)
                <option value="{{ $list->id }}"> {{ Str::upper(Str::limit($list->description,110)) }}</option>
                @endforeach
            
                </x-form.dropdown> --}}
               

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