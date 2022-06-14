<div class="p-4">
    <x-form.basic-form wire:submit.prevent="">
        <div class="pb-4 mb-2 border-b-2">
            <label for="profile_img" class="flex items-center space-x-4">
                <img 
                    class="border-4 rounded-full h-28 w-28 border-primary-800" 
                    src="
                    @if($profile_img)
                        {{$profile_img->temporaryUrl()}}
                    @else
                        {{asset('img/defaultUser.png')}}
                    @endif
                    " 
                    alt="Rounded avatar"
                > 
                <span>
                    <p class="font-semibold">USERNAME</p>  
                    <a class="text-sm font-semibold cursor-pointer text-primary-600 hover:text-primary-700">
                        Change Avatar
                    </a>
                </span>
            </label>
            <input 
                type="file" 
                class="absolute invisible pointer-events-none" 
                id="profile_img" 
                name="profile_img" 
                wire:model="profile_img"
            >
        </div>
        <x-general.grid mobile="1" gap="5" sm="1" md="2" lg="2" xl="2" class="col-span-12 mt-6">
            
            <x-form.input 
                label="Full Name" 
                name="" 
                value="" 
                mandatory="true"
                disable=""
                type="text"
            />
            
            <x-form.input 
                label="IC Number"
                name="" 
                value="" 
                mandatory=""
                disable="true"
                type="text"
            />
            
            <x-form.dropdown 
                label="Identity Type"
                value=""
                name="" 
                id=""
                mandatory=""
                disable=""
                default="yes"  
            >
                <option value="1">AWAM</option>
                <option value="2">POLIS</option>
                <option value="3">TENTERA</option>
            </x-form.dropdown>
            
            <x-form.input 
                label="No.Tentera/No.Polis"
                name="" 
                value="" 
                mandatory=""
                disable="true"
                type="text"
            />

            <x-form.input 
                label="Birth Date"
                name="" 
                value="" 
                mandatory=""
                disable="true"
                type="date"
            />

            <x-form.dropdown 
                label="Sector"
                value=""
                name="" 
                id=""
                mandatory=""
                disable=""
                default="yes"  
            >
                <option value="1">AWAM</option>
                <option value="2">SWASTA</option>
            </x-form.dropdown>

            <x-form.input 
                label="No.Phone"
                name="" 
                value="" 
                mandatory=""
                disable="true"
                type="text"
            />

            <x-form.input 
                label="Current Position"
                name="" 
                value="" 
                mandatory="true"
                disable=""
                type="text"
            />
            
            <x-form.input-tag 
                label="Salary" 
                name="" 
                value=""
                leftTag="RM"
                rightTag=""
                mandatory="true"
                disable=""
                type="text"
            />

            <x-form.input 
                label="No.Employee"
                name="" 
                value="" 
                mandatory=""
                disable=""
                type="text"
            />

            <x-form.input-tag 
                label="Total Fixed Allowance" 
                name="" 
                value=""
                leftTag="RM"
                rightTag=""
                mandatory=""
                disable=""
                type="text"
            />

            <x-form.input 
                label="Name Kementerian/Suruhanjaya/Syarikat"
                name="" 
                value="" 
                mandatory=""
                disable=""
                type="text"
            />
            <x-form.input-tag 
                label="Monthly Deduction Amount (As per salary statement)" 
                name="" 
                value=""
                leftTag="RM"
                rightTag=""
                mandatory=""
                disable=""
                type="text"
            />
            
            <x-form.input 
                label="Name Jabatan/Bahagian/Unit"
                name="" 
                value="" 
                mandatory="true"
                disable=""
                type="text"
            />

            <x-form.dropdown 
                label="Job Status"
                value=""
                name="" 
                id=""
                mandatory=""
                disable=""
                default="yes"  
            >
                <option value="1">TETAP</option>
                <option value="2">KONTRAK</option>
            </x-form.dropdown>
        </x-general.grid>
        <x-general.grid mobile="1" gap="5" sm="1" md="1" lg="1" xl="1" class="col-span-12">
            <x-form.address class="mt-8"
                label="Address"
                value1="address1"
                value2="address2"
                value3="address3"
                value4="town"
                value5="postcode"
                value6="state"
                {{-- :state="$states" --}}
                state="$states"
                condition="state"
            />

            <x-form.address class="mt-6"
                label="Employer address"
                value1="address1"
                value2="address2"
                value3="address3"
                value4="town"
                value5="postcode"
                value6="state"
                {{-- :state="$states" --}}
                state="$states"
                condition="state"
                mandatory="true"
            />
        </x-general.grid>

        <div class="p-4 mt-6 rounded-md bg-gray-50">
            <div class="flex items-center justify-center space-x-2">
                <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                    Cancel
                </a>
                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Submit
                </button>
            </div>
        </div>
    </x-form.basic-form>    
</div>