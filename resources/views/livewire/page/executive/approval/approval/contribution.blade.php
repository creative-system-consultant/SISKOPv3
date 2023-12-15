<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
    <x-form.input-tag
        label="Add Contribution applied"
        type="text"
        name="cont_apply"
        value="{{ $Application->apply_amt ?? '0.00' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
    <x-form.input-tag
        label="Add Contribution approved"
        type="text"
        name="Application.approved_amt"
        value=""
        placeholder=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $disable }}"
        wire:model="Application.approved_amt"
    />
    <x-form.input
        label="Date Options"
        value="{{ $Application->start_apply == NULL ? 'One Month' : 'Starting Date' }}"
        name="cont_type"
        id="cont_type"
        mandatory=""
        disable="true"
        default="yes"
    />
    @if ( $Application->start_apply !== NULL)
        <x-form.input
            label="Start Date"
            name="start_contDate"
            value="{{ $Application->start_apply == NULL ? '' : $Application->start_apply->format('Y-m-d') }}"
            mandatory=""
            disable="true"
            type="date"
        />
    @endif
    @if ( $Application->start_apply !== NULL)
        <x-form.input
            label="Approved Start Date"
            name="start_approvedDate"
            value="{{ $Application->start_approved == NULL ? '' : $Application->start_approved->format('Y-m-d') }}"
            mandatory=""
            disable=""
            type="date"
        />
    @endif
</div>