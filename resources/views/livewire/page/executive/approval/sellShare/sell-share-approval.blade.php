<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Share Reimbursement Application</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Seller Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $approve->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $approve->customer->icno ?? '' }}"
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
                        <option @if ($bank->code == $approve->bank_code) selected @endif>{{ $bank->description }}</option>
                    @endforeach
                </x-form.dropdown>

                <x-form.input
                    label="Account Bank No."
                    name="bank_acct"
                    id="bank_acct"
                    value="{{ $approve->bank_account ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>

            @if( $approve->direction !== 'sell' )
            <div>
                <div>
                    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Buyer Information</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                        <x-form.input
                            label="Member Name"
                            name="buyer_name"
                            value="{{ $approve->exc_cust_id == NULL ? '' : $approve->buyer->name ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />

                        <x-form.input
                            label="Member IC No."
                            name="buyer_icno"
                            value="{{ $approve->exc_cust_id == NULL ? '' : $approve->buyer->icno ?? '' }}"
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
                        value="{{ $approve->apply_amt ?? '' }}"
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
                        value="{{ $approve->approved_amt ?? '' }}"
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
                        value="{{ $approve->direction == 'sell' ? 'Co-operative' : 'Member' }}"
                        name="share_type"
                        id="share_type"
                        mandatory=""
                        disable="true"
                    />
                </div>
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Share Reimbursement Result</h2>
            <div class="grid grid-cols-12 gap-6 mt-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Maker"
                        name="precheck_by"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Result"
                        name="share_result"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area
                        label="Note / Comment : ({{ strlen($Approval->note) }}/255)"
                        value=""
                        name="precheck_note"
                        rows=""
                        disable="true"
                        mandatory=""
                        placeholder=""
                    />
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6 mt-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Checker"
                        name="approved_by"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Result"
                        name="buyershare_result"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area
                        label="Note / Comment by Checker"
                        value=""
                        name="approved_note"
                        rows=""
                        disable="true"
                        mandatory=""
                        placeholder=""
                    />
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6 mt-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Committee"
                        name="committee_by"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area
                        label="Note / Comment By Committee"
                        value="committee_note"
                        name=""
                        rows=""
                        disable="true"
                        mandatory=""
                        placeholder=""
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Vote"
                        name="committee_vote"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>
            </div>


            <div class="grid grid-cols-12 gap-6 mt-8">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Approval"
                        name="approval_by"
                        value="{{ auth()->user()->name }}"
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Result"
                        name="buyershare_result"
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area
                        label="Note / Comment By Approval"
                        value="approval_note"
                        name=""
                        rows=""
                        disable=""
                        mandatory=""
                        placeholder=""
                    />
                </div>
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                        Cancel Application
                    </button>
                    <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Previous
                     </button>
                    <button type="button" wire:click="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Approved
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
