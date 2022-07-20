<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Membership Application Maintenance</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-form.basic-form wire:submit.prevent="submit" class="p-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Customer Details</h2>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
                    <div class="flex items-center w-full">
                        <label for="your-id" class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input 
                                    type="checkbox" 
                                    id="your-id" 
                                    class="sr-only"
                                    @if($membership->field_status(2) == '1') checked @endif
                                    wire:click="enableFn(2)"
                                >
                                <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
                    Fullname
                </div>
            </div>
            {{-- <div class="p-4 mt-6 rounded-md bg-gray-50">
                <div class="flex items-center justify-center space-x-2">
                    <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                        Cancel
                    </a>
                    <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Submit
                    </button>
                </div>
            </div> --}}
        </x-form.basic-form>
    </div>
</div>
