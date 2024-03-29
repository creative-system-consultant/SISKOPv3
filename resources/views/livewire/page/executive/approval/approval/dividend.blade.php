<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
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
<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Dividend Information</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
    <x-form.input-tag
        label="Total Dividend"
        type="text"
        name=""
        value="{{ $Application->dividend_total }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
</div>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
    <x-form.input-tag
        label="To Member's Bank Applied"
        type="text"
        name="cont_apply"
        value="{{ number_format($Application->div_cash_apply,2) ?? '0.00' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
    <x-form.input-tag
        label="To Member's Share Applied"
        type="text"
        name="cont_apply"
        value="{{ number_format($Application->div_share_apply,2) ?? '0.00' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
    <x-form.input-tag
        label="To Member's Contribution Applied"
        type="text"
        name="cont_apply"
        value="{{ number_format($Application->div_contri_apply,2) ?? '0.00' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
    <x-form.input-tag
        label="Total Dividend Applied"
        type="text"
        name="total_applied"
        value="{{ number_format($Application->div_cash_apply + $Application->div_share_apply + $Application->div_contri_apply,2) ?? '0.00' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
</div>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
    <x-form.input-tag
        label="To Member's Bank Approved"
        type="text"
        name="Application.div_cash_approved"
        value=""
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $disable }}"
        wire:model="Application.div_cash_approved"
    />
    <x-form.input-tag
        label="To Member's Share Approved"
        type="text"
        name="Application.div_share_approved"
        value=""
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $disable }}"
        wire:model="Application.div_share_approved"
    />
    <x-form.input-tag
        label="To Member's Contribution Approved"
        type="text"
        name="Application.div_contri_approved"
        value=""
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $disable }}"
        wire:model="Application.div_contri_approved"
    />
</div>