<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Share Information</h2>
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
        <x-form.input-tag
            label="Add Share Capital applied"
            type="text"
            name="share_apply"
            value="{{ $Application->apply_amt ?? '0.00' }}"
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="true"
        />
    </div>
    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
        <x-form.input-tag
            label="Add Share Capital approved"
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
    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
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
</div>

@if ( $Application->method == 'online' )
    <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3" >
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
                Show Upload Online Payment Receipt
            </label>
            @forelse ($Application->files as $doc)
                <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                    Show
                </a>
            @empty
                <h2 class="mb-4 ml-4 text-base border-gray-300">No Document</h2>
            @endforelse
        </div>
    </div>
@endif

@if ( $Application->method == 'cash' )
    <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
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
                Show Upload CDM Payment Receipt
            </label>
            @forelse ($Application->files as $doc)
                <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                    Show
                </a>
            @empty
                <h2 class="mb-4 ml-4 text-base border-gray-300">No File</h2>
            @endforelse
        </div>
    </div>
@endif

@if ( $Application->method == 'cheque' )
    <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
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
                label="Cheque"
                name="cheque_clear"
                value=""
                mandatory=""
                disable=""
                type="date"
            />
        </div>
    </div>
@endif

<div class="grid grid-cols-12 gap-6 mt-6">
    <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
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
    </div>
</div>