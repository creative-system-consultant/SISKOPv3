<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Share Reimbursement Application (COMMITTEE)</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Seller Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $committee->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $committee->customer->icno ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.dropdown
                    label="Bank"
                    value=""
                    name="bank_code"
                    id="bank_code"
                    mandatory=""
                    disable="true"
                    default="yes"
                    >
                    @foreach ($banks ?? [] as $bank)
                        <option @if ($bank->code == $committee->bank_code) selected @endif>{{ $bank->description }}</option>
                    @endforeach
                </x-form.dropdown>

                <x-form.input
                    label="Account Bank No."
                    name="bank_acct"
                    id="bank_acct"
                    value="{{ $committee->bank_account ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>

            @if( $committee->direction !== 'sell' )
            <div>
                <div>
                    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Buyer Information</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                        <x-form.input
                            label="Member Name"
                            name="buyer_name"
                            value="{{ $committee->exc_cust_id == NULL ? '' : $committee->buyer->name ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />

                        <x-form.input
                            label="Member IC No."
                            name="buyer_icno"
                            value="{{ $committee->exc_cust_id == NULL ? '' : $committee->buyer->icno ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                    </div>
                </div>
            </div>
            @endif

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Share Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <div>
                    <x-form.input-tag
                        label="Reimbursement of Share Capital applied"
                        type="text"
                        name="share_apply"
                        value="{{ $committee->apply_amt ?? '0.00' }}"
                        placeholder="0.00"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>

                <div>
                    <x-form.input-tag
                        label="Reimbursement of Share Capital approved"
                        type="text"
                        name="share_approved"
                        value="{{ $committee->apply_amt ?? '0.00' }}"
                        placeholder="0.00"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>
                <div>
                    <x-form.input
                        label="Types of Share Reimbursement"
                        value="{{ $committee->direction == 'sell' ? 'Co-operative' : 'Member' }}"
                        name="share_type"
                        id="share_type"
                        mandatory=""
                        disable="true"
                    />
                </div>
            </div>

            <br>
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Previous Approvals</h2>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="Approval By / Role" sort="" />
                    <x-table.table-header class="text-left" value="Approval" sort="" />
                    <x-table.table-header class="text-left" value="Note" sort="" />
                    <x-table.table-header class="text-left" value="Date" sort="" />
                </x-slot>
                <x-slot name="tbody">
                @foreach ($committee->approvals as $item)
                @if((str_contains($item->type,'vote') && $item->vote == NULL) || $item->type == NULL) @continue @endif
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
                            @if($item->type == NULL || (str_contains($item->type,'vote') && $item->vote == NULL)) - @else {{ $item->updated_at }} @endif
                        </x-table.table-body>
                    </tr>
                @endforeach
                </x-slot>
            </x-table.table>
            @if($Approval->order == 1) No Approvals Yet @endif
            <br>
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval</h2>
            <div class="grid grid-cols-12 gap-6 mt-8">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area
                        label="Note / Comment : ({{ strlen($Approval->note) }}/255)"
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
                        value="{{ $committee->current_approval_role()->name }}"
                        mandatory=""
                        disable="readonly"
                        type="text"
                    />
                </div>
            </div>
            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                        VOTE REFUSE
                    </button>
                    <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        BACK
                     </button>
                    <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        VOTE APPROVE
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
