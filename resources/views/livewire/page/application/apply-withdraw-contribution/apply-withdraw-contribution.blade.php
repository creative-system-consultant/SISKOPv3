<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Withdrawal Contribution</h1>
    <x-general.card class="pt-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Name"
                    name="custname"
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                    wire:model.defer="cust.name"
                />
                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                    wire:model.defer="cust.icno"
                />

                <x-form.input-tag
                    label="Current Contribution Amount"
                    type="text"
                    name="current_cont"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    wire:model.defer="total_contribution"
                />

                <x-form.input-tag
                    label="Monthly Contribution"
                    type="text"
                    name="monthly_cont"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    wire:model.defer="monthly_contribution"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-2 xl:grid-cols-4">
                <div>
                    <x-form.dropdown
                        label="Bank"
                        value=""
                        name="cust.bank_id"
                        id=""
                        mandatory=""
                        disable="true"
                        default="yes"
                        wire:model="cust.bank_id"
                    >
                        @foreach ($bank_id as $list)
                            <option value="{{ $list->id }}"> {{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
                </div>

                <div>
                    <x-form.input
                        label="Bank Account No."
                        name="bank_acct"
                        id="bank_acct"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                        wire:model="bank_acct"
                    />
                </div>
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>
            <x-form.basic-form wire:submit.prevent="alertConfirm">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div>
                        <x-form.input-tag
                            label="Withdraw Contribution"
                            type="text"
                            name="cont_apply"
                            value=""
                            placeholder="0.00"
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable=""
                            wire:model.defer="cont_apply"
                        />
                    </div>
                </div>


                <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                    <div class="flex items-center justify-center space-x-2">
                        <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                            Submit
                        </button>
                    </div>
                </div>
            </x-form.basic-form>
        </div>
    </x-general.card>
</div>

@push('js')
<script>
    window.addEventListener('swal:confirm', event => {
        swal.fire({
            icon: event.detail.type,
            title: event.detail.text,
            showCancelButton: true,
            cancelButtonText: 'Cancel'
        }).then(function(result){
            if(result.isConfirmed){
                window.Livewire.emit('submit');
            }
        });
    });
</script>
@endpush