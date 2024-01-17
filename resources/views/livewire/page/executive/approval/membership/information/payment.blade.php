<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Payment Information</h2>
<div class="mb-3 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="REGISTRATION FEE"
        type="text"
        name="Application.register_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $input_maker }}"
        wire:model="Application.register_fee"
        wire:keydown.debounce.1500ms="totalfee"
    />
    <x-form.dropdown
        label="SHARE TYPE"
        value=""
        name="Application.share_pmt_mode_flag"
        id=""
        mandatory=""
        disable="{{ $input_maker }}"
        default="no"
        wire:model="Application.share_pmt_mode_flag"
        wire:change="totalfee"
    >
        <option value="1">LUMP SUM</option>
        <option value="2">MONTHLY</option>
    </x-form.dropdown>
    <x-form.input-tag
        label="SHARE FEE"
        type="text"
        name="Application.share_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $input_maker }}"
        wire:model="Application.share_fee"
        wire:keydown.debounce.1500ms="totalfee"
    />
    <x-form.input-tag
        label="SHARE MONTHLY"
        type="text"
        name="Application.share_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $input_maker }}"
        wire:model="Application.share_monthly"
        wire:keydown.debounce.1500ms="totalfee"
    />
    <x-form.input-tag
        label="CONTRIBUTION UPFRONT"
        type="text"
        name="Application.contribution_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $input_maker }}"
        wire:model="Application.contribution_fee"
        wire:keydown.debounce.1500ms="totalfee"
    />
    <x-form.input-tag
        label="CONTRIBUTION MONTHLY"
        type="text"
        name="Application.contribution_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $input_maker }}"
        wire:model="Application.contribution_monthly"
        wire:keydown.debounce.1500ms="totalfee"
    />
</div>
<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Registration Payment</h2>
<div class="mb-3 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="TOTAL FEE PAYABLE"
        type="text"
        name=""
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="readonly"
        wire:model="Application.total_fee"
    />
    <x-form.input-tag
        label="TOTAL MONTHLY (start next month)"
        type="text"
        name="Application.total_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="readonly"
        wire:model="Application.total_monthly"
    />
    <x-form.dropdown
        label="REGISTRATION PAYMENT TYPE"
        value=""
        name="Application.payment_type"
        id=""
        mandatory=""
        disable="{{ $input_maker }}"
        default="no"
        wire:model="Application.payment_type"
    >
        <option value="1">ONLINE</option>
        <option value="2">AUTOPAY</option>
    </x-form.dropdown>
    @if($Application->payment_type == 1)
    <x-form.dropdown
        label="COOP BANK"
        value=""
        name="Application.client_bank_id"
        id=""
        mandatory=""
        disable="{{ $input_maker }}"
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
    @endif
</div>
