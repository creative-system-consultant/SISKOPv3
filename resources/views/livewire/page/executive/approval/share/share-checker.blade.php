<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Add Share Application (CHECKER)</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $checker->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $checker->customer->icno ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input-tag
                    label="Current Share Capital Amount"
                    type="text"
                    name="current_share"
                    value="{{ $checker->amt_before ?? '' }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Share Information</h2>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input-tag
                        label="Add Share Capital applied"
                        type="text"
                        name="share_apply"
                        value="{{ $checker->apply_amt ?? '0.00' }}"
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
                        name="share_approved"
                        value="{{ $checker->apply_amt ?? '0.00' }}"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable=""
                    />
                </div>

                <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Payment Method"
                        value="{{ $checker->method == NULL ? '' : ucwords($checker->method) }}"
                        name="pay_method"
                        id="pay_method"
                        mandatory=""
                        disable="true"
                        >
                    </x-form.dropdown>
                </div>
            </div>

            @if ( $checker->method == 'online' )
                <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3" >
                    <div>
                        <x-form.input
                            label="Online Payment Date"
                            name="online_date"
                            value="{{ $checker->online_date == NULL ? '' : $checker->online_date->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"
                        />
                    </div>

                    <div>
                        <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
                            Show Upload Online Payment Receipt
                        </label>
                        @forelse ($checker->files as $doc)
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

            @if ( $checker->method == 'cash' )
                <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div>
                        <x-form.input
                            label="CDM Payment Date"
                            name="cdm_date"
                            value="{{ $checker->cdm_date == NULL ? '' : $checker->cdm_date->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"
                        />
                    </div>

                    <div>
                        <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
                            Show Upload CDM Payment Receipt
                        </label>
                        @forelse ($checker->files as $doc)
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

            @if ( $checker->method == 'cheque' )
                <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div>
                        <x-form.input
                            label="Cheque No."
                            name="cheque_no"
                            value="{{ $checker->cheque_no ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                    </div>

                    <div>
                        <x-form.input
                            label="Cheque Date"
                            name="cheque_date"
                            value="{{ $checker->cheque_date == NULL ? '' : $checker->cheque_date->format('Y-m-d') }}"
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

            <br>
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Previous Approvals</h2>
            <div class="grid grid-cols-12 gap-6 mt-8">
                @foreach ($checker->approvals as $item)
                    @if($item->order == $checker->step) @break @endif
                    <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                        <x-form.text-area
                            label="Note / Comment"
                            value="{{ $item->note }}"
                            name=""
                            rows=""
                            disable="readonly"
                            mandatory=""
                            placeholder=""
                        />
                        <x-form.input
                            label="Check By"
                            name="precheck_by"
                            value="{{ $item->user?->name }}"
                            mandatory=""
                            disable="readonly"
                            type="text"
                        />
                        <x-form.input
                            label=""
                            name="Role"
                            value="{{ $item->rolegroup?->name }}"
                            mandatory=""
                            disable="readonly"
                            type="text"
                        />
                    </div>
                @endforeach
            </div>
            @if($Approval->order == 1) No Approvals Yet @endif
            <br>
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval</h2>
            <div class="grid grid-cols-12 gap-6 mt-8">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area
                        label="Note / Comment"
                        value=""
                        name="Approval.note"
                        rows=""
                        disable=""
                        mandatory=""
                        placeholder=""
                        wire:model="Approval.note"
                    />
                    <x-form.input
                        label="Check By"
                        name="precheck_by"
                        value="{{ $User->name }}"
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input
                        label=""
                        name="Role"
                        value="{{ $checker->current_approval_role()->name }}"
                        mandatory=""
                        disable="readonly"
                        type="text"
                    />
                </div>
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                        Cancel Application
                    </button>
                    <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Previous
                     </button>
                    <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
