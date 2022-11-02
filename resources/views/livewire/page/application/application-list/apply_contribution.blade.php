<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
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

                <x-form.input-tag
                    label="Add Contribution applied"
                    type="text"
                    name="cont_apply"
                    value="{{ $custApply->apply_amt ?? '0.00' }}"
                    placeholder="0.00"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />

                <x-form.input-tag
                    label="Add Contribution approved"
                    type="text"
                    name="cont_approved"
                    value="{{ $custApply->approved_amt ?? '' }}"
                    placeholder="0.00"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input
                        label="Date Options"
                        value="{{ isset($custApply->start_apply) == NULL ? 'One Month' : 'Starting Date' }}"
                        name="cont_type"
                        id="cont_type"
                        mandatory=""
                        disable="true"
                        default="yes"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    @if (isset($custApply->start_apply) && $custApply->start_apply !== NULL)
                        <x-form.input
                            label="Start Date"
                            name="start_contDate"
                            value="{{ isset($custApply->start_apply) == NULL ? '' : $custApply->start_apply->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"
                        />
                    @endif
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    @if (isset($custApply->start_apply) && $custApply->start_apply !== NULL)
                        <x-form.input
                            label="Approved Start Date"
                            name="start_approvedDate"
                            value="{{ isset($custApply->start_approved) == NULL ? '' : $custApply->start_approved->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"
                        />
                    @endif
                </div>
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button @click="openModal = false" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>