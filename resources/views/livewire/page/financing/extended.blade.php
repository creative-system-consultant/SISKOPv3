<div class="p-4 @if ($numpage != 2) hidden @endif ">
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="p-4"> 
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Introducer </h2> 

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Name"
                    type="text" 
                    name="" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model=""
                />      
                <x-form.input 
                    label="IC Number"
                    type="text"
                    name="" 
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="" 
                /> 
            </div>
            <div class="mt-2 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Membership Number"
                    type="text" 
                    name="" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model=""
                />      
            </div>
        </div>
        <div class="p-4"> 
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Guarantor </h2> 
        </div>
        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-yellow-500 rounded-md focus:outline-none">
                    Previous
                </button>

                <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Next
                </button>
            </div>
        </div>

    </x-general.card>
</div>