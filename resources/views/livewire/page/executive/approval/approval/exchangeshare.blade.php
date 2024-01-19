
<div>
    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Seller Information</h2>
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
            label="Bank Name"
            name=""
            value="{{ $Application->customer->bank?->description }}"
            mandatory=""
            disable="true"
            type="text"
        />
        <x-form.input
            label="Account Bank No."
            name=""
            value="{{ $Application->bank_account }}"
            mandatory=""
            disable="true"
            type="text"
        />
    </div>
</div>
<div>
    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Buyer Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
        <x-form.input
            label="Member Name"
            name=""
            value="{{ $Application->buyer->name }}"
            mandatory=""
            disable="true"
            type="text"
        />
        <x-form.input
            label="Member Ic No"
            name=""
            value="{{ $Application->buyer->identity_no }}"
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
            label="Transfer Share applied"
            type="text"
            name=""
            value="{{ $Application->apply_amt }}"
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="true"
        />
        <x-form.input-tag
            label="Transfer Share approved"
            type="text"
            name=""
            value=""
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="{{ $disable }}"
            wire:model=""
            wire:model="Application.approved_amt"
        />
        <x-form.input
            label="Types of Transfer"
            name=""
            value="MEMBER"
            mandatory=""
            disable="true"
            type="text"
        />
    </div>
</div>






