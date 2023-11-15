
<div x-show="active == 4">
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Introducer Details </h2>

        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4">
            <x-form.input
                label="SEARCH INTRODUCER (by IC Number)"
                name="search"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:keyup="searchUser"
                wire:model.debounce.1000ms="search"
            />
        </div>

        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 mt-4">
            <x-form.input
                label="INTRODUCER NAME"
                name="CustIntroducer.name"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model="CustIntroducer.name"
                readonly
            />
            <x-form.input
                label="INTRODUCER IC NUMBER"
                name="CustIntroducer.icno"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model="CustIntroducer.icno"
                readonly
            />
            <x-form.input
                label="INTRODUCER EMAIL"
                name="CustIntroducer.email"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model="CustIntroducer.email"
                readonly
            />
            <x-form.input
                label="INTRODUCER MEMBERSHIP NUMBER"
                name="CustIntroducer.mbr_no"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model="CustIntroducer.mbr_no"
                readonly
            />
        </div>

        <div class="p-4 mt-6 rounded-md  bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" wire:click="previous" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Previous
                </button>
                <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>
