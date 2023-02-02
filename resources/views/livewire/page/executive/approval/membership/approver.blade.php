<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Membership Application (APPROVER)</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $Approver->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $Approver->customer->icno ?? '' }}"
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
                        value="{{ $Approver->register_fee }}"
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
                        value="{{ $Approver->share_fee }}"
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
                        value="{{ $Approver->contribution_fee }}"
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
                @foreach ($Approver->approvals as $item)
                    @if($item->order == $Approver->step)
                        @if($item->vote == NULL) @break 
                        @elseif($item->type == 'vote1')
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-8">
                        @endif
                    @endif
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
                        @if($item->vote != NULL)
                        <x-form.input
                            label="Vote"
                            name="vote"
                            value="{{ $item->vote }}"
                            mandatory=""
                            disable="readonly"
                            type="text"
                        />
                        <x-form.input
                            label="Vote By"
                            name="vote_by"
                            value="{{ $item->user?->name }}"
                            mandatory=""
                            disable="readonly"
                            type="text"
                        />
                        @else
                        <x-form.input
                            label="Approval"
                            name="approval"
                            value="{{ $item->type }}"
                            mandatory=""
                            disable="readonly"
                            type="text"
                        />
                        <x-form.input
                            label="Approval By"
                            name="approval_by"
                            value="{{ $item->user?->name }}"
                            mandatory=""
                            disable="readonly"
                            type="text"
                        />
                        @endif
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
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval Vote</h2>
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
                        value="{{ $Approver->current_approval_role()->name }}"
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
                    @if($Approver->step > 1)
                    <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Previous
                     </button>
                     @endif
                    <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        VOTE APPROVE
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
