@section('title', 'Retrieve Account')


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
                        Retrieve Account
                    </h2>
                </div>
                @if (session()->has('accountMessage'))
                    <div class="p-4 rounded-md bg-green-50">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>

                            <div class="ml-3">
                                <p class="text-sm font-medium leading-5 text-green-800">
                                    {{ session('accountMessage') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <form wire:submit.prevent="sendRetreiveAccountLink">
                        <div>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input
                                    wire:model.lazy="icno"
                                    id="icno"
                                    name="icno"
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

                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-primary-800 hover:bg-primary-900 focus:outline-none focus:border-gray-700 focus:ring-indigo active:bg-gray-700">
                                   Send Retrieve Account Link
                                </button>
                            </span>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <!-- for align left login -->
        {{-- @include('include.auth-title') --}}

    </div>
</div>
