<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Add Share</h1>
    <x-general.card class="pt-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
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
                    wire:model.defer="cust.identity_no"
                />

                <x-form.input-tag
                    label="Current Share"
                    type="text"
                    name="current_share"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    wire:model.defer="total_share"
                />
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Share Information</h2>
            <x-form.basic-form wire:submit.prevent="alertConfirm" x-data="{isSelect : '', show: false }">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                        <x-form.input-tag
                            label="Amount Apply"
                            type="text"
                            name="share_apply"
                            value=""
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable=""
                            wire:model.defer="share_apply"
                        />
                    </div>

                    <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                        <x-form.dropdown
                            label="Payment Method"
                            value=""
                            name="pay_method"
                            id="pay_method"
                            mandatory=""
                            disable=""
                            default="yes"
                            x-model="isSelect"
                            wire:model="pay_method"
                            >
                            <option value="online">Online Transfer/CDM</option>
                            <option value="cheque">By Cheque</option>
                        </x-form.dropdown>
                    </div>
                </div>

                <div  x-cloak x-show="isSelect == 'online' ? show = true : show = false">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                        <div>
                            <x-form.input
                                label="Online Payment Date"
                                name="online_date"
                                value=""
                                mandatory=""
                                disable=""
                                type="date"
                                wire:model="online_date"

                            />
                        </div>

                        <div>
                            <x-form.input
                                label="Upload Receipt (jpg/png/jpeg/pdf format only)"
                                name="online_file"
                                id="online_file"
                                value=""
                                mandatory=""
                                disable=""
                                type="file"
                                accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                                wire:model="online_file"
                            />
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                        <div>
                            <x-form.input-tag
                            label="COOP Bank Name"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            leftTag=""
                            rightTag=""
                            type="text"
                            wire:model="client_bank_name"
                        />
                        </div>

                        <div>
                            <x-form.input-tag
                            label="COOP Bank Account Number"
                            name=""
                            value=""
                            mandatory=""
                            disable="true"
                            leftTag=""
                            rightTag=""
                            type="text"
                            wire:model="client_bank_acct"
                        />
                        </div>
                    </div>
                </div>


                <div  x-cloak x-show="isSelect == 'cheque' ? show = true : show = false">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">

                        <div>
                            <x-form.input
                                label="Cheque No."
                                name=""
                                value=""
                                mandatory=""
                                disable=""
                                type="text"
                                wire:model="cheque_no"
                            />
                        </div>

                        <div>
                            <x-form.input
                                label="Cheque Date"
                                name="cheque_date"
                                value=""
                                mandatory=""
                                disable=""
                                type="date"
                                wire:model="cheque_date"
                            />
                        </div>

                        <div>
                            <x-form.input
                                label="Upload Cheque (jpg/png/jpeg/pdf format only)"
                                name="cheque_file"
                                id="cheque_file"
                                value=""
                                mandatory=""
                                disable=""
                                type="file"
                                accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                                wire:model="cheque_file"
                            />
                        </div>

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