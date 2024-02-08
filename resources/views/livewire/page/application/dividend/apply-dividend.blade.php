<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Dividend Withdrawal</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Information</h2>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
                <ul>
                    <li> 1. Each Member can only apply once every year</li>
                    <li> 2. Each Application are subject to changes by the COOP</li>
                </ul>
            </div>
        </div>
        <br>
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Applicant Information</h2>
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
                    value="{{ $Cust->fmsMembership->mbr_no }}"
                    mandatory=""
                    disable="true"
                />
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Total Share"
                    name=""
                    value="{{ $Cust->fmsMembership->total_share }}"
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
                    value="{{ $Cust->fmsMembership->total_contribution }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
        </div>
        <br>
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Dividend Information</h2>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Eligible Dividend"
                    name=""
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                    placeholder="0.00"
                    wire:model="Dividend.bal_dividen"
                />
            </div>
            <div class="col-span-12 sm:col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Total Dividend Withdrawal "
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

            <div class="col-span-12 sm:col-span-12 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Current Balance Dividend"
                    name="payout"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    type="text"
                    placeholder="0.00"
                    wire:model="cur_bal_dividend"
                />
            </div>
        </div>
        <br>
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Dividend Withdrawal Application</h2>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-4 mt-4 mb-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.checkbox
                    label="CASH"
                    id="payout_cash"
                    name="payout_cash"
                    value=""
                    disable=""
                    wire:model="payout_cash"
                    wire:click.debounce.1000ms="updatePayout"
                />
            </div>
            <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Amount"
                    id="apply.div_cash_apply"
                    name="apply.div_cash_apply"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model="apply.div_cash_apply"
                    wire:keyup.debounce.1000ms="updatePayout"
                />
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-4 mt-4 mb-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.checkbox
                    label="SHARE"
                    id="payout_share"
                    name="payout_share"
                    value=""
                    disable=""
                    wire:model="payout_share"
                    wire:click.debounce.1000ms="updatePayout"
                />
            </div>
            <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Amount"
                    id="apply.div_share_apply"
                    name="apply.div_share_apply"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model="apply.div_share_apply"
                    wire:keyup.debounce.1000ms="updatePayout"
                />
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-4 mt-4 mb-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.checkbox
                    label="CONTRIBUTION"
                    id="payout_contri"
                    name="payout_contri"
                    value=""
                    disable=""
                    wire:model="payout_contri"
                    wire:click.debounce.1000ms="updatePayout"
                />
            </div>
            <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2">
                <x-form.input-tag
                    label="Amount"
                    id="apply.div_contri_apply"
                    name="apply.div_contri_apply"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    type="text"
                    wire:model="apply.div_contri_apply"
                    wire:keyup.debounce.1000ms="updatePayout"
                />
            </div>
        </div>

        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-none">
                    Cancel
                </a>
                <button type="button" wire:click="deb" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Debug
                </button>
                <button type="button" wire:click="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Submit
                </button>
            </div>
        </div>
    </x-general.card>
</div>