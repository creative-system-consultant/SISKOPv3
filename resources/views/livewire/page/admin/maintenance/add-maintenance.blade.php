<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Add Maintenance</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-general.header-title title="Infomation Maintenance" route="{{route('list-maintenance')}}"/>
        
        <x-form.basic-form wire:submit.prevent="" class="p-4">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.dropdown 
                    label="Panel Type"
                    value=""
                    name="" 
                    id=""
                    mandatory=""
                    disable=""
                    default="yes"  
                >
                    <option value="1">1</option>
                </x-form.dropdown>
                <x-form.input 
                    label="Panel Name"
                    type="text" 
                    name="" 
                    value="" 
                    mandatory=""
                    disable=""
                />
            </div>
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                <x-form.text-area 
                    label="Description" 
                    value="" 
                    name="" 
                    id="" 
                    rows=""
                    placeholder="" 
                />
            </div>
            <div class="grid grid-cols-1 gap-6 mt-10 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3">
                <x-form.dropdown 
                    label="Comission Type"
                    value=""
                    name="" 
                    id=""
                    mandatory=""
                    disable=""
                    default="yes"  
                >
                    <option value="1">1</option>
                </x-form.dropdown>
                <x-form.input-tag 
                    label="Comission Percentage"
                    type="text"
                    name="" 
                    value=""
                    leftTag=""
                    rightTag="%"
                    mandatory=""
                    disable=""
                />
                <x-form.input-tag 
                    label="Comission Amount"
                    type="text"
                    name="" 
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                />
            </div>

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
</div>
        
