<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Add Contribution Application</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
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

                <x-form.input-tag
                    label="Add Contribution applied"
                    type="text"
                    name="cont_apply"
                    value="{{ $approve->apply_amt ?? '0.00' }}"
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
                    value="{{ $approve->approved_amt ?? '' }}"
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
                        value="{{ $approve->start_apply == NULL ? 'One Month' : 'Starting Date' }}"
                        name="cont_type"
                        id="cont_type"
                        mandatory=""
                        disable="true"
                        default="yes"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    @if ( $approve->start_apply !== NULL)
                        <x-form.input
                            label="Start Date"
                            name="start_contDate"
                            value="{{ $approve->start_apply == NULL ? '' : $approve->start_apply->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"
                        />
                    @endif
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    @if ( $approve->start_apply !== NULL)
                        <x-form.input
                            label="Approved Start Date"
                            name="start_approvedDate"
                            value="{{ $approve->start_approved == NULL ? '' : $approve->start_approved->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"
                        />
                    @endif
                </div>
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval Infromation</h2>
            <div class="grid grid-cols-12 gap-6 mt-8">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area
                        label="Note / Comment By Maker"
                        value=""
                        name="precheck_note"
                        rows=""
                        disable="true"
                        mandatory=""
                        placeholder=""
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area
                        label="Note / Comment By Checker"
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
