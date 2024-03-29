@isset($Contribution)
<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $Contribution->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $Contribution->customer->icno ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input-tag
                    label="Current Contribution"
                    type="text"
                    name="cont_approved"
                    value="{{ $Contribution->amt_before ?? '' }}"
                    placeholder="0.00"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />
            </div>
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Application Information{{$Contribution->start_type}}</h2>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Contribution Type"
                    value="{{ $Contribution->start_type == 2 ? 'Change Monthly Contribution'  :  'Pay Once'}}"
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
                    value="{{ $Contribution->apply_amt ?? '0.00' }}"
                    placeholder="0.00"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />
                <x-form.input-tag
                    label="Amount Approved"
                    type="text"
                    name="cont_approved"
                    value="{{ $Contribution->approved_amt ?? '' }}"
                    placeholder="0.00"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />
                @if ((isset($Contribution->start_apply) && $Contribution->start_apply !== NULL) && $Contribution->start_type == 2)
                <div>
                    <x-form.input
                        label="Start Date"
                        name="start_contDate"
                        value="{{ isset($Contribution->start_apply) == NULL ? '' : $Contribution->start_apply->format('Y-m-d') }}"
                        mandatory=""
                        disable="true"
                        type="date"
                    />
                </div>
                <div>
                    <x-form.input
                        label="Approved Start Date"
                        name="start_approvedDate"
                        value="{{ $Contribution->start_approved }}"
                        mandatory=""
                        disable="true"
                        type="date"
                    />
                </div>
                @else
                <div>
                    <x-form.input
                        label="Payment Type"
                        name="start_approvedDate"
                        value="{{ strtoupper($Contribution->method) }}"
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>
                @endif
            </div>
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approvals</h2>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="Status" sort="" />
                    <x-table.table-header class="text-left" value="Approval By" sort="" />
                    <x-table.table-header class="text-left" value="Role" sort="" />
                    <x-table.table-header class="text-left" value="Approval" sort="" />
                    <x-table.table-header class="text-left" value="Note" sort="" />
                    <x-table.table-header class="text-left" value="Date" sort="" />
                </x-slot>
                <x-slot name="tbody">
                @foreach ($Contribution->approvals as $item)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            @if($item->order < $Contribution->step || $Contribution->flag > 19)
                                <x-heroicon-o-check-circle class="w-6 h-6 text-green-500"/>
                            @elseif($item->order == $Contribution->step)
                                <x-heroicon-o-play-circle class="w-6 h-6 text-blue-500"/>
                            @endif
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $item->user?->name ?? "-" }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
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
                    @if($Contribution?->flag == 1)
                        <button wire:click="remake_approvals" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 border-2 rounded-md focus:outline-non">
                            RESET APPROVALS
                        </button>
                    @endif
                    <button @click="openModal = false" wire:click="clearApplication" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
@endisset