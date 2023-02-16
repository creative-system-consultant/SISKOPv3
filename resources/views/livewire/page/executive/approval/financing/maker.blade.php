<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Financing Application (MAKER)</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
            <x-form.input
                label="Name"
                name="applicant_name"
                value="{{ $Customer->name }}"
                mandatory=""
                disable="true"
                type="text"
            />
            <x-form.input
                label="IC No."
                name="applicant_icno"
                value="{{ $Customer->icno }}"
                mandatory=""
                disable="true"
                type="text"
            />
        </div>
        <br>
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Financing Information</h2>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            <x-form.input
                label="Financing Name"
                id="financing_name"
                name="financing_name"
                value="{{ $Account->product->name }}"
                mandatory=""
                disable="true"
                type="text"
            />
            <x-form.input
                label="Financing Type"
                id="financing_type"
                name="financing_type"
                value="{{ $Account->product->type->description }}"
                mandatory=""
                disable="true"
                type="text"
            />
            <x-form.input-tag
                label="Financing Requested"
                id="purchase_price"
                name="purchase_price"
                value="{{ $Account->purchase_price }}"
                mandatory=""
                leftTag="RM"
                rightTag=""
                disable="true"
                type="text"
            />
            <x-form.input-tag
                label="Financing Term Requested"
                name="duration"
                value="{{ $Account->duration }}"
                mandatory=""
                disable="true"
                leftTag=""
                rightTag="YEAR"
                type="text"
            />
        </div>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            <x-form.input-tag
                label="Financing Rate"
                name="finaning_rate"
                value="{{ $Account->profit_rate }}"
                mandatory=""
                disable="true"
                leftTag=""
                rightTag="%"
                type="text"
            />
            <x-form.input-tag
                label="Selling Price"
                id="Account.selling_price"
                name="Account.selling_price"
                value=""
                mandatory=""
                disable="true"
                leftTag="RM"
                rightTag=""
                type="text"
            />
            <x-form.input-tag
                label="Total Profit"
                id="Account.selling_price"
                name="Account.selling_price"
                value=""
                mandatory=""
                disable="true"
                leftTag="RM"
                rightTag=""
                type="text"
            />
            <x-form.input-tag
                label="Monthly Payment"
                id="Account.selling_price"
                name="Account.selling_price"
                value=""
                mandatory=""
                disable="true"
                leftTag="RM"
                rightTag=""
                type="text"
            />
        </div>
        <br>
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Financing Approval</h2>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            <x-form.input-tag
                label="Approved Price"
                name="Account.selling_price"
                id="Account.selling_price"
                value=""
                leftTag="RM"
                rightTag=""
                mandatory=""
                disable=""
                type="text"
                wire:model="Account.selling_price"
            />
            <x-form.input-tag
                label="Approved Duration"
                name="Account.approved_duration"
                id="Account.approved_duration"
                value=""
                mandatory=""
                leftTag=""
                rightTag="YEAR"
                disable=""
                type="text"
                wire:model="Account.approved_duration"
            />
        </div>
        <br>
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Financing Charges</h2>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            <x-form.input-tag
                label="Process Charge"
                name=""
                id=""
                value=""
                mandatory=""
                leftTag="RM"
                rightTag=""
                disable=""
                type="text"
            />
            <x-form.input-tag
                label="Duty Stamp"
                name=""
                id=""
                value=""
                mandatory=""
                leftTag="RM"
                rightTag=""
                disable=""
                type="text"
            />
            <x-form.input-tag
                label="Takaful"
                name=""
                id=""
                value=""
                mandatory=""
                leftTag="RM"
                rightTag=""
                disable=""
                type="text"
            />
        </div>
        <br>
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Previous Approvals</h2>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left" value="Approval By / Role" sort="" />
                <x-table.table-header class="text-left" value="Approval" sort="" />
                <x-table.table-header class="text-left" value="Note" sort="" />
                <x-table.table-header class="text-left" value="Date" sort="" />
            </x-slot>
            <x-slot name="tbody">
            @foreach ($Account->approvals as $item)
            @if((str_contains($item->type,'vote') && $item->vote == NULL) || $item->type == NULL) @continue @endif
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->user?->name ?? "-" }} <br>
                        {{ $item->rolegroup?->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        @if(str_contains($item->type,'vote')) {{ $item->vote ?? "-" }} @else {{ $item->type ?? "-" }} @endif
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->note ?? "-" }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        @if($item->type == NULL || (str_contains($item->type,'vote') && $item->vote == NULL)) - @else {{ $item->updated_at }} @endif
                    </x-table.table-body>
                </tr>
            @endforeach
            </x-slot>
        </x-table.table>
        @if($Approval->order == 1) No Approvals Yet @endif
        <br>
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval</h2>
        <div class="grid grid-cols-12 gap-6 mt-8">
            <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                <x-form.text-area
                    label="Note / Comment"
                    value=""
                    name="Approval.note"
                    rows=""
                    disable=""
                    mandatory=""
                    placeholder=""
                    wire:model="Approval.note"
                />
                <x-form.input
                    label="Check By"
                    name="precheck_by"
                    value="{{ $User->name }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label=""
                    name="Role"
                    value="{{ $Account->current_approval_role()->name }}"
                    mandatory=""
                    disable="readonly"
                    type="text"
                />
            </div>
        </div>

        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                    Cancel Application
                </button>
                <button wire:click="debug" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    debug
                </button>
                <button wire:click="back" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Previous
                 </button>
                <button wire:click="next" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                   Next
                </button>
            </div>
        </div>
    </x-general.card>
</div>