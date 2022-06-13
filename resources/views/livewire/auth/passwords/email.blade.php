@section('title', 'Set Semula Kata Laluan')


<div>
    @include('include.auth-bg')
    <div class="relative justify-center min-h-screen mx-0 sm:flex sm:flex-row items-center">
        @include('include.auth-title')
        <div class="flex self-center justify-center">
            <div class="p-12 mx-auto bg-white rounded-xl w-96  md:w-100 shadow-lg  h-screen md:h-full flex justify-center flex-col">
                <div class="sm:mx-auto sm:w-full sm:max-w-md mb-6 border-b-2 pb-4">
                    <x-logo class="w-auto h-20 mx-auto text-primary" />
                    <h2 class="mt-2 text-2xl font-extrabold text-center text-gray-900 leading-9">
                        Set Semula Kata Laluan
                    </h2>
                </div>
                @if ($emailSentMessage)
                    <div class="rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>

                            <div class="ml-3">
                                <p class="text-sm leading-5 font-medium text-green-800">
                                    {{ $emailSentMessage }}
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <form wire:submit.prevent="sendResetPasswordLink">
                        <div>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input 
                                    wire:model.lazy="email" 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    placeholder="Alamat E-mel"
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
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-primary-800 border border-transparent rounded-md hover:bg-primary-900 focus:outline-none focus:border-gray-700 focus:ring-indigo active:bg-gray-700 transition duration-150 ease-in-out">
                                    Hantar Link Set Semula Kata Laluan
                                </button>
                            </span>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>


