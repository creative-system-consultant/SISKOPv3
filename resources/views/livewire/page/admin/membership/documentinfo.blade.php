<div class="@if ($numpage != 4) hidden @endif">
<h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Document Details</h2>
<div class="grid grid-cols-1 gap-6 mt-50 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-2">

        <div @if ($member->document_status('IC') == '0') style="display: none" @endif >
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

        <div @if ($member->document_status('WC') == '0') style="display: none" @endif >
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


        <div @if ($member->document_status('P1') == '0') style="display: none" @endif >
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


        <div @if ($member->document_status('P2') == '0') style="display: none" @endif >
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

        <div class="flex items-center justify-center space-x-2">
            <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                previous
            </button>

            <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                Next
            </button>

        </div>
    </div>