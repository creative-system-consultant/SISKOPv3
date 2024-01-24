<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Payment Information</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="MEMBER REGISTRATION FEE"
        type="text"
        name="Application.register_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable=""
        wire:model="Application.register_fee"
        wire:keydown="totalfee"
    />
    <x-form.input-tag
        label="CONTRIBUTION"
        type="text"
        name="Application.contribution_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable=""
        wire:model="Application.contribution_fee"
        wire:keydown="totalfee"
    />
    <x-form.input-tag
        label="SHARE"
        type="text"
        name="Application.share_fee"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable=""
        wire:model="Application.share_fee"
        wire:keydown="totalfee"
    />
</div>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="TOTAL FEE"
        type="text"
        name=""
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable="readonly"
        wire:model="Application.total_fee"
    />
</div>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input-tag
        label="CONTRIBUTION MONTHLY"
        type="text"
        name="Application.contribution_monthly"
        value=""
        leftTag="RM"
        rightTag=""
        mandatory="true"
        disable="{"
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
        disable=""
        wire:model="Application.share_monthly"
        wire:keydown="totalfee"
    />
</div>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
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