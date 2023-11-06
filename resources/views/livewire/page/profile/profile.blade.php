<div class="p-4">
    <x-form.basic-form wire:submit.prevent="submit('{{ $User->id }}')" class="p-4">
        {{-- <div class="pb-4 mb-2 border-b-2">

            <div class="flex items-center space-x-4">
                <img
                    class="border-4 rounded-full h-28 w-28 border-primary-800"
                    src="
                    @if($profile_img)
                        {{ $profile_img->temporaryUrl() }}
                    @else
                        {{ asset('img/defaultUser.png') }}
                    @endif
                    "
                    alt="Rounded avatar"
                >
                <label for="profile_img">
                    <p class="font-semibold">USERNAME</p>
                    <a class="text-sm font-semibold cursor-pointer text-primary-600 hover:text-primary-700">
                        Change Avatar
                    </a>
                </label>
            </div>
            <input
                type="file"
                class="absolute invisible pointer-events-none"
                id="profile_img"
                name="profile_img"
                wire:model="profile_img"
            >
        </div>--}}

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 ">
            <x-form.input
                label="Full Name"
                id="User.name"
                name="User.name"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="User.name"
            />
            <x-form.input
                label="IC Number"
                id="User.icno"
                name="User.icno"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="User.icno"
            />
            <x-form.input
                label="Phone No"
                id="User.phone_no"
                name="User.phone_no"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="User.phone_no"
            />
            <x-form.input
                label="Email"
                id="User.email"
                name="User.email"
                value=""
                mandatory="true"
                disable=""
                type="text"
                wire:model="User.email"
            />
        </div>

        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <a href="{{ url()->previous() }}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                    Cancel
                </a>
                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Update
                </button>
            </div>
        </div>
    </x-form.basic-form>
</div>