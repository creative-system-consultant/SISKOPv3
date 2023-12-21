<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information - {{ $Application->id }}</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
    <x-form.input-tag
        label="Add Contribution applied"
        type="text"
        name="Application.apply_amt"
        value="{{ $Application->apply_amt ?? '0.00' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
        wire:model="Application.apply_amt"
    />
    <x-form.input-tag
        label="Add Contribution approved"
        type="text"
        name="Application.approved_amt"
        value="{{ $Application->approved_amt ?? '0.00' }}"
        placeholder=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $disable }}"
        wire:model="Application.approved_amt"
    />

    <x-form.input
        label="Account Bank No."
        name="Application.bank_account"
        value="{{ $Application->bank_account ?? '-' }}"
        mandatory=""
        disable="true"
        type="text"
    />

    <x-form.input
        label="Bank Name"
        name="bank_name"
        value="{{ $Application->bankname() ?? '-' }}"
        mandatory=""
        disable="true"
        type="text"
    />
</div>
