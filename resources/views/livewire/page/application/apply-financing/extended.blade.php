

<!-- Guarantor -->
<div  x-show="active == 5">
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Guarantor </h2>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4">
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
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 mt-4">
            <x-form.input
                label="Guarantor NAME"
                name="Guarantor.name"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model="Guarantor.name"
                readonly
            />
            <x-form.input
                label="Guarantor IC NUMBER"
                name="Guarantor.icno"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model="Guarantor.icno"
                readonly
            />
            <x-form.input
                label="Guarantor EMAIL"
                name="Guarantor.email"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model="Guarantor.email"
                readonly
            />
            <x-form.input
                label="Guarantor MEMBERSHIP NUMBER"
                name="Guarantor.mbr_no"
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model="Guarantor.mbr_no"
                readonly
            />
            <x-form.dropdown
                label="Guarantor RELATIONSHIP"
                value=""
                name=""
                id=""
                mandatory=""
                disable=""
                default="yes"
                wire:model=""
                wire:change=""
            >
            @foreach ($relationship as $list)
                <option value="{{ $list->id }}"> {{ $list->description }}</option>
            @endforeach
            </x-form.dropdown>
        </div>
        <div class="grid grid-cols-1 gap-2 mt-4">
            <x-form.address class="mt-2"
                label="Guarantor ADDRESS"
                mandatory=""
                disable=""
                name1=""
                name2=""
                name3=""
                name4=""
                name5=""
                name6=""
                name7=""
                {{-- :state="" --}}
                condition="state"
            /> 
        </div>
    </div>
</div>

<!-- Referrer -->
<div  x-show="active == 6">
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Referrer </h2>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4">
            <x-form.input
                label="SEARCH Referrer (by IC Number)"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:keyup="searchGuarantor"
                wire:model.debounce.1000ms="search_guarantor"
            />
        </div>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 mt-4">
            <x-form.input
                label="Referrer NAME"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model=""
                readonly
            />
            <x-form.input
                label="Referrer IC NUMBER"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model=""
                readonly
            />
            <x-form.input
                label="Referrer EMAIL"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model=""
                readonly
            />
            <x-form.input
                label="Referrer MEMBERSHIP NUMBER"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model=""
                readonly
            />
            <x-form.dropdown
                label="Referrer RELATIONSHIP"
                value=""
                name=""
                id=""
                mandatory=""
                disable=""
                default="yes"
                wire:model=""
                wire:change=""
            >
            @foreach ($relationship as $list)
                <option value="{{ $list->id }}"> {{ $list->description }}</option>
            @endforeach
            </x-form.dropdown>
        </div>
        <div class="grid grid-cols-1 gap-2 mt-4">
            <x-form.address class="mt-2"
                label="Referrer ADDRESS"
                mandatory=""
                disable=""
                name1=""
                name2=""
                name3=""
                name4=""
                name5=""
                name6=""
                name7=""
                {{-- :state="" --}}
                condition="state"
            /> 
        </div>
    </div>
</div>

<!-- Payment -->
<div  x-show="active == 7">
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Payment </h2>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 mt-4">
            <x-form.dropdown
                label="Payment Made by"
                value=""
                name=""
                id=""
                mandatory=""
                disable=""
                default="yes"
                wire:model=""
                wire:change=""
            >
                <option value=""></option>
            </x-form.dropdown>
            <x-form.input
                label="Member No"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model=""
                readonly
            />
            <x-form.input
                label="Full Name"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model=""
                readonly
            />
            <x-form.input
                label="IC No"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model=""
                readonly
            />
            <x-form.dropdown
                label="Payment Type"
                value=""
                name=""
                id=""
                mandatory=""
                disable=""
                default="yes"
                wire:model=""
                wire:change=""
            >
                <option value=""></option>
            </x-form.dropdown>
            <x-form.input
                label="Autopay"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model=""
                readonly
            />
            <x-form.input
                label="SI"
                name=""
                value=""
                mandatory=""
                disable=""
                type="text"
                wire:model=""
                readonly
            />
        </div>
    </div>
</div>

<div x-show="active == 5 || active == 6 || active == 7">
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
</div>
