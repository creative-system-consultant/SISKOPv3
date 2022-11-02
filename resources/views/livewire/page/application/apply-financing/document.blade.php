<div class="p-4 @if ($numpage != 3) hidden @endif ">
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Application Documents </h2>
        <div class="mt-4 bg-white rounded-md">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                <x-form.input
                    label="File"
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

    </x-general.card>
</div>