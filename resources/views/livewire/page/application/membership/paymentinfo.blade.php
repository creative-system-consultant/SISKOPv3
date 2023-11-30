<div x-show="active == 5">
    <!-- Deduction -->
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Deduction </h2>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4">
            <div>
                <x-form.input-tag
                    label="Member Fee (One-time only)"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="applymember.register_fee"
                /> 
            </div>
            <div>
                <x-form.input-tag
                    label="Contribution (Minimum RM50)"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="applymember.contribution_fee"
                /> 
            </div>
            <div>
                <x-form.input-tag
                    label="Share Monthly (Minimum RM50)"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="applymember.share_monthly"
                /> 
            </div>
            <div>
                <x-form.input-tag
                    label="Share (Minimum RM500)"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="applymember.share_fee"
                /> 
            </div>
            {{-- <div>
                <x-form.dropdown
                    label="Type of Deduction Payment"
                    value=""
                    name=""
                    id=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                >
                <option value=""></option>
                </x-form.dropdown>
            </div> --}}
            <div>
                <x-form.input-tag
                    label="Total"
                    name=""
                    value=""
                    mandatory=""
                    disable="readonly"
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="applymember.total_fee"
                /> 
            </div>
        </div>
    </div>

    <!-- Payment -->
    
    {{-- <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Payment </h2>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4">
            <div>
                <x-form.dropdown
                    label="Payment Made by"
                    value=""
                    name=""
                    id=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                >
                <option value=""></option>
                </x-form.dropdown>
            </div>
            <div>
                <x-form.input
                    label="Member No."
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                />
            </div>
            <div>
                <x-form.input
                    label="Full Name"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                />
            </div>
            <div>
                <x-form.input
                    label="IC No"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                />
            </div>
            <div>
                <x-form.dropdown
                    label="Payment Type"
                    value=""
                    name=""
                    id=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                >
                <option value=""></option>
                </x-form.dropdown>
            </div>
            <div>
                <x-form.input
                    label="Autopay"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                />
            </div>
            <div>
                <x-form.input
                    label="SI"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model=""
                />
            </div>
        </div>
    </div> --}}

    <div  class="px-6 py-4 mt-4">
        <div class="p-4 mt-6 rounded-md  bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" wire:click="previous" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Previous
                </button>
                <button type="button" wire:click="next({{$numpage}},0)" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>
