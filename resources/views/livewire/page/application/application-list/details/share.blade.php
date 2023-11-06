@isset($share)
<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $share->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $share->customer->icno ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input-tag
                    label="Current Share Capital Amount"
                    type="text"
                    name="current_share"
                    value="{{ $share->amt_before ?? '' }}"
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
                        value="{{ $share->apply_amt ?? '0.00' }}"
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
                        value="{{ $share->approved_amt ?? '0.00' }}"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Payment Method"
                        value="{{ isset($share->method) == NULL ? '' : ucwords($share->method) }}"
                        name="pay_method"
                        id="pay_method"
                        mandatory=""
                        disable="true"
                        >
                    </x-form.dropdown>
                </div>
            </div>

            @if (isset($share->method) && $share->method == 'online' )
                <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3" >
                    <div>
                        <x-form.input
                            label="Online Payment Date"
                            name="online_date"
                            value="{{ isset($share->online_date) == NULL ? '' : $share->online_date->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"
                        />
                    </div>

                    <div>
                        <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
                            Show Upload Online Payment Receipt
                        </label>
                        @if (isset($share->files) != NULL)
                            @forelse ($share->files as $doc)
                                <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                    Show
                                </a>
                            @empty
                                <h2 class="mb-4 ml-4 text-base border-gray-300">No Document</h2>
                            @endforelse
                        @endif
                    </div>
                </div>
            @endif

            @if (isset($share->method) && $share->method == 'cash' )
                <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div>
                        <x-form.input
                            label="CDM Payment Date"
                            name="cdm_date"
                            value="{{ isset($share->cdm_date) == NULL ? '' : $share->cdm_date->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"
                        />
                    </div>

                    <div>
                        <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
                            Show Upload CDM Payment Receipt
                        </label>
                        @if (isset($share->files) != NULL)
                            @forelse ($share->files as $doc)
                                <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                    Show
                                </a>
                            @empty
                                <h2 class="mb-4 ml-4 text-base border-gray-300">No File</h2>
                            @endforelse
                        @endif
                    </div>
                </div>
            @endif

            @if (isset($share->method) && $share->method == 'cheque' )
                <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div>
                        <x-form.input
                            label="Cheque No."
                            name="cheque_no"
                            value="{{ $share->cheque_no ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                    </div>

                    <div>
                        <x-form.input
                            label="Cheque Date"
                            name="cheque_date"
                            value="{{ isset($share->cheque_date) == NULL ? '' : $share->cheque_date->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"
                        />
                    </div>
                </div>
            @endif

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approvals</h2>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="Approval By / Role" sort="" />
                    <x-table.table-header class="text-left" value="Approval" sort="" />
                    <x-table.table-header class="text-left" value="Note" sort="" />
                    <x-table.table-header class="text-left" value="Date" sort="" />
                </x-slot>
                <x-slot name="tbody">
                @foreach ($share->approvals as $item)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $item->user?->name ?? "-" }} <br>
                            {{ $item->rolegroup?->name }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            @if(str_contains($item->type,'vote')) {{ $item->vote ?? "-" }} @else {{ $item->type ?? "-" }} @endif
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $item->note ?? "-" }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            @if($item->type == NULL || (str_contains($item->type,'vote') && $item->vote == NULL)) - @else {{ $item->updated_at->format('d-m-Y H:i a') }} @endif
                        </x-table.table-body>
                    </tr>
                @endforeach
                </x-slot>
            </x-table.table>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button @click="openModal = false" wire:click="clearApplication" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
@endisset