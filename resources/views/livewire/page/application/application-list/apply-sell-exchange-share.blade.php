@isset($sellShare)
<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information - {{ $sellShare?->id }}</h2>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $sellShare->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $sellShare->customer->icno ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input-tag
                    label="Current Share"
                    type="text"
                    name="current_share"
                    value="{{ $sellShare->amt_before ?? '' }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />
            </div>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 mt-4">
                <x-form.input
                    label="Bank"
                    name="bank_acct"
                    id="bank_acct"
                    value="{{ $sellShare->customer->bank?->description }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Account Bank No."
                    name="bank_acct"
                    id="bank_acct"
                    value="{{ $sellShare->customer->bank_acct_no ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Share Information</h2>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <div>
                    <x-form.input-tag
                        label="Amount Applied"
                        type="text"
                        name="share_apply"
                        value="{{ $sellShare->apply_amt ?? '' }}"
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
                        name="share_approved"
                        value="{{ $sellShare->approved_amt ?? '' }}"
                        placeholder="0.00"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>
                <div>
                    <x-form.input
                        label="Sell To"
                        value="COOP"
                        name="share_type"
                        id="share_type"
                        mandatory=""
                        disable="true"
                    />
                </div>
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approvals</h2>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="Approval By / Role" sort="" />
                    <x-table.table-header class="text-left" value="Approval" sort="" />
                    <x-table.table-header class="text-left" value="Note" sort="" />
                    <x-table.table-header class="text-left" value="Date" sort="" />
                </x-slot>
                <x-slot name="tbody">
                @foreach ($sellShare->approvals as $item)
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
                    <div class="flex items-center justify-center space-x-2">
                        <button @click="openModal = false" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
@endisset