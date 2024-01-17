<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Add/Change Contribution</h1>
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
                    wire:model.defer="cust.identity_no"
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

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>
            <x-form.basic-form wire:submit.prevent="alertConfirm" x-data="{select: '', showing: '', isSelect: false}">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                        <x-form.input-tag
                            label="New Contribution Amount"
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

                    <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                        <x-form.dropdown
                            label="Types of Add Contribution"
                            value=""
                            name="cont_type"
                            id="cont_type"
                            mandatory=""
                            disable=""
                            default="yes"
                            x-model="select"
                            wire:model="cont_type"
                            >
                            <option value="pay_once">Pay Once </option>
                            <option value="cont_date">Change Monthly Contribution From Date</option>
                        </x-form.dropdown>
                    </div>
                
                </div>

                <div x-cloak x-show ="select == 'pay_once'">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 mb-6 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                            <x-form.dropdown
                                label="Payment Method"
                                value=""
                                name="payment_method"
                                id="payment_method"
                                mandatory=""
                                disable=""
                                default="yes"
                                x-model="showing"
                                wire:model="payment_method"
                                >
                                <option value="online">Online Banking/Cash Payment</option>
                                <option value="cheque">By Cheque</option>
                            </x-form.dropdown>
                        </div>
                    </div>

                    <div x-cloak x-show="showing == 'online' ? isSelect = true : isSelect = false">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                            <div>
                                <x-form.input
                                    label="Payment Date"
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
                                    label="Upload Online/Cash Payment Receipt:(uploaded only: jpg/png/jpeg/pdf)"
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

                    <div x-cloak x-show="showing == 'cheque' ? isSelect = true : isSelect = false">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">

                            <div>
                                <x-form.input
                                    label="Cheque No."
                                    name="cheque_no"
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
                                    label="Upload Cheque:(uploaded only: jpg/png/jpeg/pdf)"
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
                </div>

                <div x-cloak x-show ="select == 'cont_date'">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 mb-6 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                                <x-form.input
                                    label="Start Date"
                                    name="start_contDate"
                                    value=""
                                    mandatory=""
                                    disable=""
                                    type="date"
                                    wire:model="start_contDate"
                                />
                        </div>
                    </div>

                    
                </div>


                <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                    <div class="flex items-center justify-center space-x-2">
                        <button type="submit"  class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
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