<div class="@if ($numpage != 2) hidden @endif">
test

<div class="p-4 mt-6 rounded-md bg-gray-50">
    <div class="flex items-center justify-center space-x-2">
        


        <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
            previous
        </button>

        <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
            Next
        </button>

        <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
            Submit
        </button>
        
    </div>
</div>
</div>