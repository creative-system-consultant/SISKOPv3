<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Seller Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $custApply->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $custApply->customer->icno ?? '' }}"
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
                        <option @if ($bank->code == $custApply->bank_code) selected @endif>{{ $bank->description }}</option>
                    @endforeach
                </x-form.dropdown>

                <x-form.input
                    label="Account Bank No."
                    name="bank_acct"
                    id="bank_acct"
                    value="{{ $custApply->bank_account ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>

            @if(isset($custApply->direction) && $custApply->direction !== 'sell'  )
            <div>
                <div>
                    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Buyer Information</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                        <x-form.input
                            label="Member Name"
                            name="buyer_name"
                            value="{{ isset($custApply->exc_cust_id) && $custApply->exc_cust_id == NULL ? '' : $custApply->buyer->name ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />

                        <x-form.input
                            label="Member IC No."
                            name="buyer_icno"
                            value="{{ isset($custApply->exc_cust_id) && $custApply->exc_cust_id == NULL ? '' : $custApply->buyer->icno ?? '' }}"
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
                        value="{{ $custApply->apply_amt ?? '' }}"
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
                        value="{{ $custApply->approved_amt ?? '' }}"
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
                        value="{{ isset($custApply->direction) && $custApply->direction == 'sell' ? 'Co-operative' : 'Member' }}"
                        name="share_type"
                        id="share_type"
                        mandatory=""
                        disable="true"
                    />
                </div>
            </div>
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
