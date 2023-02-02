<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Membership Application (CHECKER)</h1>
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
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Membership Information</h2>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input-tag
                        label="Register FEE"
                        type="text"
                        name="register_fee"
                        value="{{ $checker->register_fee }}"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>
                <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input-tag
                        label="SHARE MONTHLY"
                        type="text"
                        name="register_fee"
                        value="{{ $checker->share_fee }}"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>
                <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input-tag
                        label="CONTRIBUTION MONTHLY"
                        type="text"
                        name="register_fee"
                        value="{{ $checker->contribution_fee }}"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>
            </div>
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
                    @if($checker->step > 1)
                    <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Previous
                     </button>
                     @endif
                    <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Approve
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
