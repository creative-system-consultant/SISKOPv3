
<div>
    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
        <x-form.input
            label="Name"
            name=""
            value="{{ $Application->customer->name }}"
            mandatory=""
            disable="true"
            type="text"
        />
        <x-form.input
            label="Identity Number"
            name=""
            value="{{ $Application->customer->identity_no }}"
            mandatory=""
            disable="true"
            type="text"
        />
        <x-form.input
            label="Bank"
            name=""
            value="{{ $Application->customer->bank?->description }}"
            mandatory=""
            disable="true"
            type="text"
        />
        <x-form.input
            label="Account Bank No."
            name=""
            value="{{ $Application->customer->bank_acct_no }}"
            mandatory=""
            disable="true"
            type="text"
        />
    </div>
</div>
<div>
    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Share Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
        <x-form.input-tag
            label="Current Share"
            type="text"
            name=""
            value="{{ $Application->customer->fmsMembership?->total_share }}"
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="true"
        />
        <x-form.input
            label="Sell To"
            name=""
            value="COOP"
            mandatory=""
            disable="true"
            type="text"
        />
        <x-form.input-tag
            label="Amount Applied"
            type="text"
            name=""
            value="{{ $Application->apply_amt }}"
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="true"
        />
        <x-form.input-tag
            label="Amount Approved"
            type="text"
            name=""
            value=""
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="{{ $disable }}"
            wire:model="Application.approved_amt"
        />
    </div>
</div>






