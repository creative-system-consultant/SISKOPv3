<div class="p-4 @if ($numpage != 2) hidden @endif ">
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">

            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Introducer </h2> 

            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-2">
                    <x-form.input 
                        label="SEARCH Introducer (by IC Number)" 
                        name="search_introducer" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:keyup="searchIntroducer"
                        wire:model.debounce.1000ms="search_introducer"
                    />
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
                    <x-form.input 
                        label="Introducer NAME" 
                        name="Introducer.name" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Introducer.name"
                        readonly
                        
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
                    <x-form.input 
                        label="Introducer IC NUMBER" 
                        name="Introducer.icno" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Introducer.icno"
                        readonly
                    />
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
                    <x-form.input 
                        label="Introducer EMAIL" 
                        name="Introducer.email" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Introducer.email"
                        readonly
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
                    <x-form.input 
                        label="Introducer MEMBERSHIP NUMBER" 
                        name="Introducer.mbr_no" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Introducer.mbr_no"
                        readonly
                    />
                </div>
            </div>

            <h2 class="mt-4 mb-4 text-base font-semibold border-b-2 border-gray-300"> Guarantor </h2> 

            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-2">
                    <x-form.input 
                        label="SEARCH Guarantor (by IC Number)" 
                        name="" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:keyup="searchGuarantor"
                        wire:model.debounce.1000ms="search_guarantor"
                    />
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
                    <x-form.input 
                        label="Guarantor Name" 
                        name="Guarantor.name" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Guarantor.name"
                        readonly
                        
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
                    <x-form.input 
                        label="Guarantor IC Number" 
                        name="Guarantor.icno" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Guarantor.icno"
                        readonly
                    />
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
                    <x-form.input 
                        label="Guarantor Email" 
                        name="Guarantor.email" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Guarantor.email"
                        readonly
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
                    <x-form.input 
                        label="Guarantor Membership Number" 
                        name="Guarantor.mbr_no" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text"
                        wire:model="Guarantor.mbr_no"
                        readonly
                    />
                </div>
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