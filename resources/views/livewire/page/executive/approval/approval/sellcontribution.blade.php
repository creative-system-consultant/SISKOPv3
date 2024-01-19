<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information - {{ $Application->id }}</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
    <x-form.input-tag
        label="Current Contribution"
        type="text"
        name=""
        value="{{ $Application->customer?->fmsMembership?->total_contribution ?? '0' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
    <x-form.input-tag
        label="Withdraw Contribution applied"
        type="text"
        name="Application.apply_amt"
        value=""
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
        wire:model="Application.apply_amt"
    />
    <x-form.input-tag
        label="Withdraw Contribution approved"
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
</div>
