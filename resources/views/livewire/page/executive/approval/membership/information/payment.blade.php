<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Payment Information</h2>
<div class="mb-3 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="REGISTRATION FEE"
        type="text"
        name="Application.register_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable="{{ $input_maker }}"
        wire:model="Application.register_fee"
        wire:keydown="totalfee"
    />
    <x-form.input
        label="Share Type"
        name=""
        value="{{ $Application->sharetype() }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input-tag
        label="SHARE"
        type="text"
        name="Application.share_lump_sum_amt"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable="{{ $input_disable }}"
        wire:model="Application.share_lump_sum_amt"
    />
    <x-form.input-tag
        label="CONTRIBUTION"
        type="text"
        name="Application.contribution_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable="{{ $input_maker }}"
        wire:model="Application.contribution_fee"
        wire:keydown="totalfee"
    />
</div>
<div class="mb-3 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="TOTAL PAYABLE"
        type="text"
        name=""
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable="readonly"
        wire:model="Application.total_fee"
    />
    <x-form.dropdown
        label="REGISTRATION PAYMENT TYPE"
        value=""
        name="Application.payment_type"
        id=""
        mandatory=""
        disable=""
        default="no"
        wire:model="Application.payment_type"
    >
        <option value="1">ONLINE</option>
        <option value="2">AUTOPAY</option>
    </x-form.dropdown>
</div>
<div class="mb-3 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.dropdown
        label="COOP BANK"
        value=""
        name="Application.client_bank_id"
        id=""
        mandatory=""
        disable=""
        default="yes"
        wire:model="Application.client_bank_id"
    >
    @foreach ($banks as $item)
        <option value="{{ $item->id }}"> {{ $item->description }}</option>
    @endforeach
    </x-form.dropdown>
    <x-form.input
        label="COOP BANK ACC NUM"
        name="Application.client_bank_acct_no"
        value=""
        mandatory=""
        disable="{{ $input_maker }}"
        type="text"
        wire:model="Application.client_bank_acct_no"
    />
    <x-form.input-tag
        label="CONTRIBUTION MONTHLY"
        type="text"
        name="Application.contribution_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable="{{ $input_maker }}"
        wire:model="Application.contribution_monthly"
        wire:keydown="totalfee"
    />
    <x-form.input-tag
        label="SHARE MONTHLY"
        type="text"
        name="Application.share_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable="{{ $input_maker }}"
        wire:model="Application.share_monthly"
        wire:keydown="totalfee"
    />
</div>
<div class="mb-3 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="MONTHLY TOTAL"
        type="text"
        name="Application.total_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable="readonly"
        wire:model="Application.total_monthly"
    />
</div>