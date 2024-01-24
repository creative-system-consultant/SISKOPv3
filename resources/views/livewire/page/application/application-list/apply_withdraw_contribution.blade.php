@isset($withdraw)
<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information - {{ $withdraw->id }}</h2>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $withdraw->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $withdraw->customer->icno ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input-tag
                    label="Current Contribution"
                    type="text"
                    name="current_cont"
                    value="{{ $withdraw->customer->fmsMembership->total_contribution  ?? '0' }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />
                <x-form.input-tag
                    label="Monthly Contribution"
                    type="text"
                    name="monthly_cont"
                    value="{{ $withdraw->customer->fmsMembership->monthly_contribution ?? '0'  }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />
                <x-form.input
                    label="Bank"
                    name="bank_name"
                    id="bank_name"
                    value="{{ $withdraw->bankname() }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Account Bank No."
                    name="bank_account"
                    id="bank_account"
                    value="{{ $withdraw->bank_account ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <div>
                    <x-form.input-tag
                        label="Amount Applied"
                        type="text"
                        name="cont_apply"
                        value="{{ $withdraw->apply_amt ?? '0.00' }}"
                        placeholder="0.00"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>
                <div>
                    <x-form.input-tag
                        label="Amount Approved"
                        type="text"
                        name="cont_approved"
                        value="{{ $withdraw->approved_amt ?? '' }}"
                        placeholder="0.00"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>
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
                @foreach ($withdraw->approvals as $item)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            @if($item->order < $withdraw->step || $withdraw->flag > 1)
                                <x-heroicon-o-check-circle class="w-6 h-6 text-green-500"/>
                            @elseif($item->order == $withdraw->step)
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
                    @if($withdraw->flag == 1)
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