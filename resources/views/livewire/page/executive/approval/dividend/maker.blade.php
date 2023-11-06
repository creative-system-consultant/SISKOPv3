<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Dividend Application (MAKER)</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                <x-form.input
                    label="Full Name"
                    name="Cust.name"
                    value="{{ $Cust->name }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
            <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-2 xl:col-span-2">
                <x-form.input
                    label="IC Number"
                    type="text"
                    name="Cust.icno"
                    value="{{ $Cust->icno }}"
                    mandatory=""
                    disable="true"
                />
            </div>
            <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-2 xl:col-span-2">
                <x-form.input
                    label="Membership Number"
                    type="text"
                    name="Cust.ref_no"
                    value="{{ $Cust->ref_no }}"
                    mandatory=""
                    disable="true"
                />
            </div>
        </div>
        <br>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Total Share"
                    name=""
                    value="{{ $Cust->share }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
            <div class="col-span-12 sm:col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Total Contribution"
                    name=""
                    value="{{ $Cust->contribution }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
        </div>
        <br>
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Dividend Information</h2>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Dividend"
                    name=""
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                    placeholder="0.00"
                    wire:model="Dividend.bal_div"
                />
            </div>
        </div>
        <br>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Total Payout Applied"
                    name=""
                    value="{{ $Apply->total_apply() }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                    placeholder="0.00"
                />
            </div>
            <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Cash Payout Apply"
                    id="Apply.div_cash_apply"
                    name="Apply.div_cash_apply"
                    value="{{ $Apply->div_cash_apply }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
            <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Share Payout Apply"
                    id="Apply.div_share_apply"
                    name="Apply.div_share_apply"
                    value="{{ $Apply->div_share_apply }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
            <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Contribution Payout Apply"
                    id="Apply.div_contri_apply"
                    name="Apply.div_contri_apply"
                    value="{{ $Apply->div_contri_apply }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
        </div>
        <br>
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Dividend Approval</h2>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Total Payout Approved"
                    name="payout"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                    placeholder="0.00"
                    wire:model="payout"
                />
            </div>
            <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Cash Payout Approved"
                    id="Apply.div_cash_apply"
                    name="Apply.div_cash_apply"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model="Apply.div_cash_approved"
                    wire:keyup.debounce.1000ms="updatePayout"
                />
            </div>
            <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Share Payout Approved"
                    id="Apply.div_share_apply"
                    name="Apply.div_share_apply"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model="Apply.div_share_approved"
                    wire:keyup.debounce.1000ms="updatePayout"
                />
            </div>
            <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Contribution Payout Approved"
                    id="Apply.div_contri_apply"
                    name="Apply.div_contri_apply"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model="Apply.div_contri_approved"
                    wire:keyup.debounce.1000ms="updatePayout"
                />
            </div>
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
            @foreach ($Apply->approvals as $item)
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
                    label="Note / Comment : ({{ strlen($Approval->note) }}/255)"
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
                    value="{{ $Apply->current_approval_role()->name }}"
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