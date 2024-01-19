<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Share Information</h2>
<div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 mb-4">
    <div >
        <x-form.input-tag
            label="Current Share"
            type="text"
            name="share_apply"
            value="{{ $Application->amt_before }}"
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="true"
        />
    </div>
    <div >
        <x-form.input-tag
            label="Amount Applied"
            type="text"
            name="share_apply"
            value="{{ $Application->apply_amt ?? '0.00' }}"
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="true"
        />
    </div>
    <div >
        <x-form.input-tag
            label="Amount Approved"
            type="text"
            name="Application.approved_amt"
            value=""
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="{{ $disable }}"
            wire:model="Application.approved_amt"
        />
    </div>
</div>


    <div class="grid grid-cols-1 gap-2 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4" >
        <div>
            <x-form.input
                label="Payment Method"
                value="{{ $Application->method == NULL ? '' : ucwords($Application->method) }}"
                name="pay_method"
                id="pay_method"
                mandatory=""
                disable="true"
                >
            </x-form.dropdown>
        </div>
        @if ( $Application->method == 'online' )
            <div>
                <x-form.input
                    label="Bank"
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
                    label="Bank No"
                    name="client_bank_acct"
                    value=""
                    mandatory=""
                    disable="readonly"
                    type="text"
                    wire:model="client_bank_acct"
                />
            </div>
            <div>
                <x-form.input
                    label="Online Payment Date"
                    name="online_date"
                    value="{{ $Application->online_date == NULL ? '' : $Application->online_date->format('Y-m-d') }}"
                    mandatory=""
                    disable="true"
                    type="date"
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
                    <h2 class="mb-4 ml-4 text-base border-gray-300">No Document</h2>
                @endforelse
            </div>
        @endif
        @if ( $Application->method == 'cash' )
            <div>
                <x-form.input
                    label="CDM Payment Date"
                    name="cdm_date"
                    value="{{ $Application->cdm_date == NULL ? '' : $Application->cdm_date->format('Y-m-d') }}"
                    mandatory=""
                    disable="true"
                    type="date"
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
                    <h2 class="mb-4 ml-4 text-base border-gray-300">No File</h2>
                @endforelse
            </div>
        @endif
        @if ( $Application->method == 'cheque' )
            <div>
                <x-form.input
                    label="Cheque No."
                    name="cheque_no"
                    value="{{ $Application->cheque_no ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
            <div>
                <x-form.input
                    label="Cheque Date"
                    name="cheque_date"
                    value="{{ $Application->cheque_date == NULL ? '' : $Application->cheque_date->format('Y-m-d') }}"
                    mandatory=""
                    disable="true"
                    type="date"
                />
            </div>
            <div>
                <x-form.input
                    label="Cheque Clearence Date"
                    name="Application.cheque_clear"
                    value=""
                    mandatory=""
                    disable=""
                    type="date"
                    wire:model="Application.cheque_clear"
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
                    <h2 class="mb-4 ml-4 text-base border-gray-300">No Document</h2>
                @endforelse
            </div>
        @endif
    </div>