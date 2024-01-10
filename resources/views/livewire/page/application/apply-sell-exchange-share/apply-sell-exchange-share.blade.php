<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Sell/Transfer Share</h1>
    <x-general.card class="pt-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4" x-data="{isSelect : '', show: false }">
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
                    wire:model.defer="cust.icno"
                />

                <x-form.input-tag
                    label="Current Share Capital Amount"
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
            <x-form.basic-form wire:submit.prevent="alertConfirm" x-data="{types: '', selected: false}">
                <div class="grid grid-cols-12 gap-6" x-cloak x-bind:class="types == 'mbr' ? 'grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4' : ''">
                    <div x-bind:class="types == 'mbr' ? '' : 'col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4'">
                        <x-form.input-tag
                            label="Share Amount"
                            type="text"
                            name="share_apply"
                            value=""
                            placeholder="0.00"
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable=""
                            wire:model.defer="share_apply"
                        />
                    </div>

                    <div x-bind:class="types == 'mbr' ? '' : 'col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4'">
                        <x-form.dropdown
                            label="Transaction Mode"
                            value=""
                            name="share_type"
                            id="share_type"
                            mandatory=""
                            disable=""
                            default="yes"
                            x-model="types"
                            wire:model="share_type"
                            >
                            <option value="coop">Sell to Co-operative </option>
                            <option value="mbr">Transfer to Member</option>
                        </x-form.dropdown>
                    </div>

                </div>
                <div x-cloak x-show="types == 'mbr' ? selected = true : selected = false">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                        <div>
                            <x-form.input
                                label="Member IC No."
                                name="mbr_icno"
                                value=""
                                mandatory=""
                                disable=""
                                type="text"
                                wire:model.debounce.1000ms="mbr_icno"
                            />
                        </div>

                        <div>
                            <x-form.input
                                label="Member Name"
                                name="mbr_name"
                                value=""
                                mandatory=""
                                disable="true"
                                type="text"
                                wire:model="mbr_name"
                            />
                        </div>
                    </div>
                </div>

                <div  x-cloak x-show="types == 'coop' ? selected = true : selected = false">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                        <div>
                            <x-form.dropdown
                                label="Bank"
                                value=""
                                name="bank_name"
                                id="bank_name"
                                mandatory=""
                                disable=""
                                default="yes"
                                wire:model.defer="bank_name"
                                >
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->code }}">{{ $bank->description }}</option>
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
                                disable=""
                                type="text"
                                wire:model.defer="bank_acct"
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