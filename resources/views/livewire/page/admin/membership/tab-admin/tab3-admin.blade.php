<x-form.basic-form wire:submit.prevent="submit" class="p-4">
    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Payment List</h2>

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="4" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input 
                            type="checkbox" 
                            id="4" 
                            class="sr-only"
                            @if($membership->field_status(4) == '1') checked @endif
                            wire:click="enableFn(4)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Register Fee
        </div>
    </div>

     <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="5" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input 
                            type="checkbox" 
                            id="5" 
                            class="sr-only"
                            @if($membership->field_status(5) == '1') checked @endif
                            wire:click="enableFn(5)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Share Fee
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="6" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input 
                            type="checkbox" 
                            id="6" 
                            class="sr-only"
                            @if($membership->field_status(6) == '1') checked @endif
                            wire:click="enableFn(6)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
           Contribution Fee
        </div>
    </div>
</x-form.basic-form>