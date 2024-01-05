<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
<div class="grid grid-cols-1 gap-2 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
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
<div class="grid grid-cols-1 gap-2 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
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
        rightTag="MONTH"
        type="text"
    />
</div>
<div class="grid grid-cols-1 gap-2 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
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
</div>
<br>
<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Financing Approval</h2>
<div class="grid grid-cols-1 gap-2 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
    <x-form.input-tag
        label="Approved Limit"
        name="Account.approved_limit"
        id="Account.approved_limit"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable=""
        type="text"
        wire:model="Account.approved_limit"
    />
    <x-form.input-tag
        label="Approved Duration"
        name="Account.approved_duration"
        id="Account.approved_duration"
        value=""
        mandatory="true"
        leftTag=""
        rightTag="MONTH"
        disable=""
        type="text"
        wire:model="Account.approved_duration"
    />
    <x-form.input-tag
        label="Selling Price"
        id="Account.selling_price"
        name="Account.selling_price"
        value=""
        mandatory=""
        disable="readonly"
        leftTag="RM"
        rightTag=""
        type="text"
        wire:model="Account.selling_price"
    />
    <x-form.input-tag
        label="Total Profit"
        id=""
        name=""
        value=""
        mandatory=""
        disable="readonly"
        leftTag="RM"
        rightTag=""
        type="text"
        wire:model="profit"
    />
    <x-form.input-tag
        label="Monthly Payment"
        id=""
        name=""
        value=""
        mandatory=""
        disable="readonly"
        leftTag="RM"
        rightTag=""
        type="text"
        wire:model="Account.instal_amount"
    />
    <div class="p-4 mt-2 rounded-md">
        <div class="flex items-center justify-center space-x-2">
            <button wire:click="calculate" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                CALCULATE
            </button>
        </div>
    </div>
</div>
<br>
<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Financing Charges</h2>
<div class="grid grid-cols-1 gap-2 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
    <x-form.input-tag
        label="Process Fee"
        name="Deduction.process_fee"
        id="Deduction.process_fee"
        value=""
        mandatory="true"
        leftTag="RM"
        rightTag=""
        disable=""
        type="text"
        wire:model="Deduction.process_fee"
    />
    <x-form.input-tag
        label="Duty Stamp"
        name="Deduction.duty_stamp"
        id="Deduction.duty_stamp"
        value=""
        mandatory="true"
        leftTag="RM"
        rightTag=""
        disable=""
        type="text"
        wire:model="Deduction.duty_stamp"
    />
    <x-form.input-tag
        label="Takaful"
        name="Deduction.insurance"
        id="Deduction.insurance"
        value=""
        mandatory="true"
        leftTag="RM"
        rightTag=""
        disable=""
        type="text"
        wire:model="Deduction.insurance"
    />
</div>