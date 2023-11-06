@section('title', 'Reset password')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}">
            <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Reset password
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit.prevent="resetPassword">
                <input wire:model="token" type="hidden">
                <div>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input
                            wire:model.lazy="email"
                            id="email"
                            type="email"
                            placeholder="email address"
                            required
                            autofocus
                            class="form-input w-full content-center text-sm px-4 py-2
                            @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"
                        />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-6">
                    <div class="mt-1 rounded-md shadow-sm">
                        <input
                            wire:model.lazy="password"
                            id="password"
                            type="password"
                            placeholder="password"
                            required
                            class="form-input w-full content-center text-sm px-4 py-2
                            @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <div class="mt-1 rounded-md shadow-sm">
                        <input
                            wire:model.lazy="passwordConfirmation"
                            id="password_confirmation"
                            placeholder="Confirm Password"
                            type="password"
                            required
                            class="form-input w-full content-center text-sm px-4 py-2"
                        />
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            Reset password
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
