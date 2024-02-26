<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>
<div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
    <x-form.input-tag
        label="Total Contribution"
        type="text"
        name=""
        value="{{ $Application->customer->fmsMembership->total_contribution ?? '0.00' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
    <x-form.input-tag
        label="Monthly Contribution"
        type="text"
        name=""
        value="{{ $Application->customer->fmsMembership->monthly_contribution ?? '0.00' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
</div>

<div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 my-4">
    <x-form.input
        label="Contribution Type"
        value="{{ $Application->start_type == 1 ? 'Pay Once' : 'Change Monthly Contribution' }}"
        name="cont_type"
        id="cont_type"
        mandatory=""
        disable="true"
        default="yes"
    />
    <x-form.input-tag
        label="Amount Applied"
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
        label="Amount Approved"
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
    @if ( $Application->method == 'cheque' )
        <x-form.input
            label="Cheque No."
            name="cheque_no"
            value="{{ $Application->cheque_no ?? '' }}"
            mandatory=""
            disable="true"
            type="text"
        />
        <x-form.input
            label="Cheque Date"
            name="cheque_date"
            value="{{ $Application->cheque_date == NULL ? '' : $Application->cheque_date->format('Y-m-d') }}"
            mandatory=""
            disable="true"
            type="date"
        />
        <x-form.input
            label="Cheque Clearence Date"
            name="Application.cheque_clear"
            value=""
            mandatory=""
            disable=""
            type="date"
            wire:model="Application.cheque_clear"
        />
        <div>
            <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
                View Document
            </label>
            @forelse ($Application->files as $doc)
                <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                    View
                </a>
            @empty
                <h2 class="mb-4 ml-4 text-base border-gray-300">No Document</h2>
            @endforelse
        </div>
    @endif
</div>

@if ( $Application->start_type == 2)
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 my-4">
            <x-form.input
                label="Start Date"
                name="start_contDate"
                value="{{ $Application->start_apply->format('Y-m-d') }}"
                mandatory=""
                disable="true"
                type="date"
            />
            
            @if($Application->current_approval()->role=='MAKER')
            <x-form.input
            label="Approved Start Date"
            name="Application.start_approved"
            value=""
            mandatory=""
            disable=""
            type="date"
            wire:model="Application.start_approved"
        />
            @else
            <x-form.input
            label="Approved Start Date"
            name="Application.start_approved"
            value=""
            mandatory=""
            disable="true"
            type="date"
            wire:model="Application.start_approved"
        />
            @endif
    </div>
    @else
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 my-4">
            <div>
                <x-form.input
                    label="Payment Method"
                    value="{{ strtoupper($Application->method) }}"
                    name=""
                    id=""
                    mandatory=""
                    disable="true"
                    default="yes"
                />
            </div>
            @if ( $Application->method == 'online' )
                <div>
                    <x-form.input
                        label="Payment Date"
                        name="date"
                        value="{{ $Application->online_date }}"
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>
                <div>
                    <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
                        View Document
                    </label>
                    @forelse ($Application->files as $doc)
                        <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                            <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                            View
                        </a>
                    @empty
                        <h2 class="mb-4 ml-4 text-base border-gray-300">No Document Uploaded</h2>
                    @endforelse
                </div>
            @endif
        </div>
        @if ( $Application->method == 'online' )
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 my-4">
            <div>
                <x-form.input
                    label="COOP Bank"
                    name="client_bank_name"
                    value=""
                    mandatory=""
                    disable="readonly"
                    type="text"
                    wire:model="client_bank_name"
                />
            </div>
            <div>
                <x-form.input
                    label="COOP Bank No"
                    name="client_bank_acct"
                    value=""
                    mandatory=""
                    disable="readonly"
                    type="text"
                    wire:model="client_bank_acct"
                />
            </div>
        </div>
        @endif
@endif
