@section('title', 'Log In')
<div>
    @include('include.auth-bg')
    <div class="relative justify-center min-h-screen mx-0 sm:flex sm:flex-row">
        @include('include.auth-title')
        <div class="flex self-center justify-center items-center">
            <form wire:submit.prevent="authenticate">
                <div class="p-12 mx-auto bg-white rounded-xl w-96  md:w-100 shadow-lg h-screen md:h-full flex justify-center flex-col">
                    <div class="mb-4">
                        <div class="sm:mx-auto sm:w-full sm:max-w-md mb-6 border-b-2 pb-4">
                            <x-logo class="w-auto h-20 mx-auto text-primary mb-4" />
                            <h3 class="text-2xl font-extrabold text-gray-900 leading-9 text-center">Log In </h3>
                            <p class="text-gray-500 text-center">Please enter your credential.</p>
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
                        <div class="flex items-center justify-between">
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
                            <div class="text-sm ml-4">
                                <a href="{{ route('retrieve-account') }}" class="text-primary-900 hover:text-primary-800 ml-5">
                                    Forget your account?
                                </a>
                                <div class="ml-3">
                                    <a href="{{ route('password.request') }}" class="text-primary-900 hover:text-primary-800">
                                        Forget your password?
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1 pt-2">
                            <button type="submit"
                                class="text-sm flex justify-center w-full p-2 font-semibold text-gray-100 border-2 border-primary-900 rounded-md  bg-primary-900 hover:bg-primary-800 focus:outline-none">
                                Log In
                            </button>
                            
                            <a href="{{ route('register') }}"
                                class="text-sm flex justify-center w-full p-2 font-semibold text-primary-900 rounded-md  border-2 border-primary-900 hover:bg-primary-800 hover:text-white focus:outline-none">
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
    </div>
    <div wire:loading wire:target="authenticate">
        <x-main-loading />
    </div>
</div>
