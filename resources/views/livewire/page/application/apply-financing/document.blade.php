<div  x-show="active == 8">
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Upload Documents </h2>
        <div class="bg-white rounded-md">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                <x-form.input
                    label="Copy of IC (Front & Back)"
                    name=""
                    id=""
                    value=""
                    mandatory="true"
                    disable=""
                    type="file"
                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                    wire:model.defer="online_file"
                />
                <x-form.input
                    label="Copy of 3 Months Payslip"
                    name=""
                    id=""
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=""
                    wire:model=""
                />
                <x-form.input
                    label="Employer Verification"
                    name=""
                    id=""
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=""
                    wire:model=""
                />
                <x-form.input
                    label="Copy of IC Guarantor (Front & Back)"
                    name=""
                    id=""
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=""
                    wire:model=""
                />
                <x-form.input
                    label="Copy of Guarantor 3 Months Payslip"
                    name=""
                    id=""
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=""
                    wire:model=""
                />
                <x-form.input
                    label="Other documents"
                    name=""
                    id=""
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=""
                    wire:model=""
                />
            </div>
        </div>
        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-yellow-500 rounded-md focus:outline-none">
                    Previous
                </button>

                <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>