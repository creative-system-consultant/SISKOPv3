<div x-show="active == 6">
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Document Details</h2>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4">
            <div>
                <x-form.input
                    label="Upload photo Of IC (Front & Back) :"
                    name="online_file"
                    id="online_file"
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                    wire:model.defer="online_file"
                />
            </div>
            <div>
                <x-form.input
                    label="Upload photo Of Worker Card (Front) :"
                    name="online_file2"
                    id="online_file2"
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                    wire:model.defer="online_file2"
                />
            </div>
            <div>
                <x-form.input
                    label="Upload photo Of Latest Paycheck :"
                    name="online_file3"
                    id="online_file3"
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                    wire:model.defer="online_file3"
                />
            </div>
            <div>
                <x-form.input
                    label="Last Month Paycheck :"
                    name="online_file4"
                    id="online_file4"
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                    wire:model.defer="online_file4"
                />
            </div>
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