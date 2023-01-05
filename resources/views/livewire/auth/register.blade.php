@section('title', 'Register Account')

<div>
    @include('include.auth-bg')
    <div class="relative items-center justify-center min-h-screen mx-0 sm:flex sm:flex-row">
        <!-- for align right login -->
        @include('include.auth-title')

        <div class="flex flex-col items-center self-center justify-center">
            <!-- for align center login -->
            {{-- @include('include.auth-title-center') --}}

            <div class="flex flex-col justify-center h-screen p-12 mx-auto bg-white shadow-lg rounded-xl w-96 md:w-100 md:h-full">
                <div class="pb-4 mb-6 border-b-2 sm:mx-auto sm:w-full sm:max-w-md">
                    <x-logo class="w-auto h-20 mx-auto text-primary" />
                    <h2 class="mt-2 text-2xl font-extrabold leading-9 text-center text-gray-900">
                        Register a New Account
                    </h2>

                    <p class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                        or
                        <a href="{{ route('login') }}" class="font-medium transition duration-150 ease-in-out text-primary focus:outline-none focus:underline text-primary-900">
                            Login to Your Account
                        </a>
                    </p>
                </div>

                <form wire:submit.prevent="register">
                    <div>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input
                                wire:model.lazy="name"
                                id="name"
                                type="text"
                                placeholder="Full Name"
                                required
                                autofocus
                                class="form-input w-full content-center text-sm px-4 py-2
                                @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"
                            />
                        </div>

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <div class="mt-1 rounded-md shadow-sm">
                            <input
                                wire:model.lazy="icno"
                                id="icno"
                                type="text"
                                placeholder="IC No."
                                required
                                autofocus
                                class="form-input w-full content-center text-sm px-4 py-2
                                @error('icno') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"
                            />
                        </div>

                        @error('icno')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <div class="mt-1 rounded-md shadow-sm">
                            <input
                                wire:model.lazy="phone_no"
                                id="phone_no"
                                type="text"
                                placeholder="Phone No."
                                required
                                autofocus
                                class="form-input w-full content-center text-sm px-4 py-2
                                @error('phone_no') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"
                            />
                        </div>

                        @error('phone_no')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <div class="mt-1 rounded-md shadow-sm">
                            <input
                                wire:model.lazy="email"
                                id="email"
                                type="email"
                                placeholder="Email Address"
                                required
                                class="form-input w-full content-center text-sm px-4 py-2
                                @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"
                            />
                        </div>

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <div class="mt-1 rounded-md shadow-sm">
                            <input
                                wire:model.lazy="password"
                                id="password"
                                type="password"
                                placeholder="Password"
                                required
                                class="form-input w-full content-center text-sm px-4 py-2
                                @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"
                            />
                        </div>

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <div class="mt-1 rounded-md shadow-sm">
                            <input
                                wire:model.lazy="passwordConfirmation"
                                id="password_confirmation"
                                type="password"
                                placeholder="Confrim Password"
                                required
                                class="content-center w-full px-4 py-2 text-sm form-input"
                            />
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="flex justify-center w-full p-2 text-sm font-semibold text-gray-100 border-2 rounded-md border-primary-900 bg-primary-900 hover:bg-primary-800 focus:outline-none">
                                Register
                            </button>
                        </span>
                    </div>
                </form>
            </div>

        </div>

        <!-- for align left login -->
        {{-- @include('include.auth-title') --}}

    </div>
</div>

