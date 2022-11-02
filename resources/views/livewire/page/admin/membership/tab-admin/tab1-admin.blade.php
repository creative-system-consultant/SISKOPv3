<x-form.basic-form wire:submit.prevent="submit" class="p-4">
    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Customer Details</h2>

    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="2" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="2"
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
            Full Name
        </div>
    </div> --}}

    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="3" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="3"
                            class="sr-only"
                            @if($membership->field_status(3) == '1') checked @endif
                            wire:click="enableFn(3)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            IC Number
        </div>
    </div> --}}

    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="7" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="7"
                            class="sr-only"
                            @if($membership->field_status(7) == '1') checked @endif
                            wire:click="enableFn(7)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Mobile Number
        </div>
    </div> --}}

    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="13" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="13"
                            class="sr-only"
                            @if($membership->field_status(13) == '1') checked @endif
                            wire:click="enableFn(13)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Address
        </div>
    </div> --}}

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="11" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="11"
                            class="sr-only"
                            @if($membership->field_status(11) == '1') checked @endif
                            wire:click="enableFn(11)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Race
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="9" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="9"
                            class="sr-only"
                            @if($membership->field_status(9) == '1') checked @endif
                            wire:click="enableFn(9)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Gender
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="12" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="12"
                            class="sr-only"
                            @if($membership->field_status(12) == '1') checked @endif
                            wire:click="enableFn(12)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Education
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="10" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="10"
                            class="sr-only"
                            @if($membership->field_status(10) == '1') checked @endif
                            wire:click="enableFn(10)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Marital
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="8" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="8"
                            class="sr-only"
                            @if($membership->field_status(8) == '1') checked @endif
                            wire:click="enableFn(8)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Email
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="1" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="1"
                            class="sr-only"
                            @if($membership->field_status(1) == '1') checked @endif
                            wire:click="enableFn(1)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Title
        </div>
    </div>

    <h2 class="mt-8 mb-4 text-base font-semibold border-b-2 border-gray-300">Parent Details</h2>

    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="14" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="14"
                            class="sr-only"
                            @if($membership->field_status(14) == '1') checked @endif
                            wire:click="enableFn(14)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Full Name
        </div>
    </div> --}}

    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="15" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="15"
                            class="sr-only"
                            @if($membership->field_status(15) == '1') checked @endif
                            wire:click="enableFn(15)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            IC Number
        </div>
    </div> --}}

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="16" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="16"
                            class="sr-only"
                            @if($membership->field_status(16) == '1') checked @endif
                            wire:click="enableFn(16)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Email
        </div>
    </div>

    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="17" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="17"
                            class="sr-only"
                            @if($membership->field_status(17) == '1') checked @endif
                            wire:click="enableFn(17)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Mobile Number
        </div>
    </div> --}}

    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="18" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="18"
                            class="sr-only"
                            @if($membership->field_status(18) == '1') checked @endif
                            wire:click="enableFn(18)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Home Address
        </div>
    </div> --}}

    <h2 class="mt-8 mb-4 text-base font-semibold border-b-2 border-gray-300">Work Details</h2>
    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="19" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="19"
                            class="sr-only"
                            @if($membership->field_status(19) == '1') checked @endif
                            wire:click="enableFn(19)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Company Name
        </div>
    </div> --}}

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="20" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="20"
                            class="sr-only"
                            @if($membership->field_status(20) == '1') checked @endif
                            wire:click="enableFn(20)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Name Of Department
        </div>
    </div>
    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="21" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="21"
                            class="sr-only"
                            @if($membership->field_status(21) == '1') checked @endif
                            wire:click="enableFn(21)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Position
        </div>
    </div>
    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="22" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="22"
                            class="sr-only"
                            @if($membership->field_status(22) == '1') checked @endif
                            wire:click="enableFn(22)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Office Telephone Number
        </div>
    </div> --}}

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="23" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="23"
                            class="sr-only"
                            @if($membership->field_status(23) == '1') checked @endif
                            wire:click="enableFn(23)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Salary
        </div>
    </div>

    {{-- <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="24" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="24"
                            class="sr-only"
                            @if($membership->field_status(24) == '1') checked @endif
                            wire:click="enableFn(24)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Worker Number
        </div>
    </div> --}}

    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="25" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input
                            type="checkbox"
                            id="25"
                            class="sr-only"
                            @if($membership->field_status(25) == '1') checked @endif
                            wire:click="enableFn(25)"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            Office Address
        </div>
    </div>
</x-form.basic-form>
