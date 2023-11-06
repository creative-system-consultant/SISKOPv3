<div class="@if ($numpage != 2) hidden @endif">
<h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Introducer Details</h2>
<div class="grid grid-cols-12 gap-6 mt-4">
    <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-2">
        <x-form.input
            label="SEARCH INTRODUCER (by IC Number)"
            name="search"
            value=""
            mandatory="true"
            disable=""
            type="text"
            wire:keyup="searchUser"
            wire:model.debounce.1000ms="search"
        />
    </div>
</div>
<div class="grid grid-cols-12 gap-6 mt-4">
    <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
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
    </div>
    <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
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
    </div>
</div>
<div class="grid grid-cols-12 gap-6 mt-4">
    <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
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
    </div>
    <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
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
</div>

    <div class="flex items-center justify-center space-x-2">
        <!-- <button type="button" wire:click="deb" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
            deb
        </button> -->
        <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
            previous
        </button>
        <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
            Next
        </button>
    </div>
</div>