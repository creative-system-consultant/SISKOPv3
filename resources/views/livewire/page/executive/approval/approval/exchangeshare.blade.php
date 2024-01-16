
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
        <x-form.dropdown
            label="Bank"
            value=""
            name="Application.bank_code"
            mandatory=""
            disable="{{ $disable }}"
            default="yes"
            wire:model="Application.bank_code"
            >
            @foreach ($banks ?? [] as $bank)
                <option value="{{ $bank->code }}">{{ $bank->description }}</option>
            @endforeach
        </x-form.dropdown>
        <x-form.input
            label="Account Bank No."
            name=""
            value=""
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
            label="Reimbursement of Share Capital applied"
            type="text"
            name=""
            value=""
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="true"
        />
        <x-form.input-tag
            label="Reimbursement of Share Capital approved"
            type="text"
            name=""
            value=""
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable=""
            wire:model=""
        />
        <x-form.input
            label="Types of Share Reimbursement"
            name=""
            value="MEMBER"
            mandatory=""
            disable="true"
            type="text"
        />
    </div>
</div>






