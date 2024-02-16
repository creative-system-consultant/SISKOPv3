<div x-show="active == 6">
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Document Details</h2>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4">
            <div>
                <x-form.input
                    label="Upload photo Of IC (Front & Back) :"
                    name="IC_Photo"
                    id="IC_Photo"
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                    wire:model.defer="IC_Photo"
                />
            </div>
            <div>
                <x-form.input
                    label="Upload photo Of Worker Card (Front) :"
                    name="Worker_Card"
                    id="Worker_Card"
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                    wire:model.defer="Worker_Card"
                />
            </div>
            <div>
                <x-form.input
                    label="Upload photo Of Latest Paycheck :"
                    name="Paycheck"
                    id="Paycheck"
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                    wire:model.defer="Paycheck"
                />
            </div>
            <div>
                <x-form.input
                    label="Last Month Paycheck :"
                    name="LastMonthPaycheck"
                    id="LastMonthPaycheck"
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                    wire:model.defer="LastMonthPaycheck"
                />
            </div>
            @if($pay_type_regist=="1" || $pay_type_share=='1')

            <div>
                <x-form.input
                label="Upload Payment Proof:"
                name="Payment_Proof"
                id="Payment_Proof"
                value=""
                mandatory=""
                disable=""
                type="file"
                accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                wire:model.defer="Payment_Proof"
            />
            </div>
            @endif
  
            
        </div>
        <div class="p-4 mt-6 rounded-md  bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" wire:click="previous" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Previous
                </button>
                <button type="button" wire:click="next({{$numpage}},0)" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>