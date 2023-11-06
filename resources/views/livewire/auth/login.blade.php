@section('title', 'Log In')
<div>
    @include('include.auth-bg')
    <div class="relative justify-center min-h-screen mx-0 sm:flex sm:flex-row">

        <!-- for align right login -->
        @include('include.auth-title')

        <div class="flex flex-col items-center self-center justify-center">

            <!-- for align center login -->
            {{-- @include('include.auth-title-center') --}}

            <form wire:submit.prevent="authenticate">
                <div class="flex flex-col justify-center h-screen p-12 mx-auto bg-white shadow-lg rounded-xl w-96 md:w-100 md:h-full">
                    <div class="mb-4">
                        <div class="pb-4 mb-6 border-b-2 sm:mx-auto sm:w-full sm:max-w-md">
                            <x-logo class="w-auto h-20 mx-auto mb-4 text-primary" />
                            <h3 class="text-2xl font-extrabold leading-9 text-center text-gray-900">Log In </h3>
                            <p class="text-center text-gray-500">Please enter your credential.</p>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div class="space-y-2">
                            <input
                                wire:model.lazy="email"
                                id="email"
                                name="email"
                                type="email"
                                placeholder="Email Address"
                                required
                                autofocus
                                class="form-input w-full content-center text-sm px-4 py-2
                                @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"
                            />
                            @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <input
                                wire:model.lazy="password"
                                id="password"
                                type="password"
                                placeholder="Password"
                                required
                                class="form-input w-full content-center text-sm px-4 py-2
                                @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"
                            />
                            @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col items-start justify-between w-full sm:items-center sm:flex-row">
                            <div class="flex items-center">
                                <input
                                    wire:model.lazy="remember"
                                    id="remember"
                                    type="checkbox"
                                    class="w-4 h-4 transition duration-150 ease-in-out text-primary-800 form-checkbox"
                                />
                                <label for="remember_me" class="block ml-2 text-sm text-gray-800">
                                    Remember Me
                                </label>
                            </div>
                            <div class="mt-4 text-sm sm:mt-0">
                                <a href="{{ route('retrieve-account') }}" class=" text-primary-900 hover:text-primary-800">
                                    Forget your account?
                                </a>
                                <div class="">
                                    <a href="{{ route('password.request') }}" class="text-primary-900 hover:text-primary-800">
                                        Forget your password?
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center pt-2 space-x-1">
                            <button type="submit"
                                class="flex justify-center w-full p-2 text-sm font-semibold text-gray-100 border-2 rounded-md border-primary-900 bg-primary-900 hover:bg-primary-800 focus:outline-none">
                                Log In
                            </button>

                            <a href="{{ route('register') }}"
                                class="flex justify-center w-full p-2 text-sm font-semibold border-2 rounded-md text-primary-900 border-primary-900 hover:bg-primary-800 hover:text-white focus:outline-none">
                                Register
                            </a>
                        </div>
                        <hr calss="mt-2"/>
                        <div class="flex justify-center">
                            <span class="text-xs">Visit
                                <a href="http://www.csc.net.my/"
                                    target="blank_"
                                    class="text-primary-800">http://www.csc.net.my/</a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <!-- for align left login -->
        {{-- @include('include.auth-title') --}}

    </div>
    <div wire:loading wire:target="authenticate">
        <x-main-loading />
    </div>
</div>
