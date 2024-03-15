<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Payment Information</h2>
<div class="mb-3 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="Registration Fee"
        type="text"
        name="Application.register_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
        wire:model="Application.register_fee"
        wire:keydown.debounce.1500ms="totalfee"
    />
    <x-form.input-tag
        label="Contribution Upfront"
        type="text"
        name="contribution_fee_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
        wire:model="contribution_fee_monthly"
        wire:keydown.debounce.1500ms="totalfee"
    />
    <x-form.input-tag
        label="Contribution Monthly"
        type="text"
        name="contribution_fee_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $input_maker }}"
        wire:model="contribution_fee_monthly"
        wire:keydown.debounce.1500ms="totalfee"
    />
    <x-form.dropdown
        label="Share Type"
        value=""
        name="share_pmt_mode_flag"
        id=""
        mandatory=""
        disable="{{ $input_maker }}"
        default="yes"
        wire:model="share_pmt_mode_flag"
        wire:change="totalfee"
    >
        <option value="1">LUMP SUM</option>
        <option value="2">MONTHLY</option>
    </x-form.dropdown>
  
    @if($share_pmt_mode_flag != 1)
    <x-form.input-tag
        label="Share Upfront"
        type="text"
        name="share_fee_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
        wire:model="share_fee_monthly"
        wire:keydown.debounce.1500ms="totalfee"
    />
    <x-form.input-tag
        label="Share Monthly"
        type="text"
        name="share_fee_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $input_maker }}"
        wire:model="share_fee_monthly"
        wire:keydown.debounce.1500ms="totalfee"
    />
    @else
    <x-form.input-tag
        label="Share Upfront"
        type="text"
        name="share_fee_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
        wire:model="share_fee_monthly"
        wire:keydown.debounce.1500ms="totalfee"
    />
    @endif
</div>
<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Registration Payment</h2>
<div class="mb-3 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="Total Fee Payable"
        type="text"
        name="total_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="readonly"
        wire:model="total_fee"
    />
    <x-form.input-tag
        label="Total Monthly"
        type="text"
        name="total_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="readonly"
        wire:model="total_monthly"
    />
</div>
<div class="mb-3 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.dropdown
        label="Registration Payment Type"
        value=""
        name="payment_type"
        id=""
        mandatory=""
        disable="{{ $input_maker }}"
        default="yes"
        wire:model="payment_type"
    >
        <option value="1">ONLINE</option>
        <option value="2">AUTOPAY</option>
    </x-form.dropdown>

    @if($payment_type == 1)
    <x-form.dropdown
        label="Coop Bank"
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
        label="Coop Bank Acc Num"
        name="Application.client_bank_acct_no"
        value=""
        mandatory=""
        disable="{{ $input_maker }}"
        type="text"
        wire:model="Application.client_bank_acct_no"
    />
    @endif
</div>
