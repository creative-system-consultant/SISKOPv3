@section('title', 'Daftar Akaun')

<div>
    @include('include.auth-bg')
    <div class="relative justify-center  min-h-screen mx-0 sm:flex sm:flex-row items-center">
        @include('include.auth-title')
        <div class="flex self-center justify-center">
            <div class="p-12 mx-auto bg-white rounded-xl w-96  md:w-100 shadow-lg  h-screen md:h-full flex justify-center flex-col">
                <div class="sm:mx-auto sm:w-full sm:max-w-md mb-6 border-b-2 pb-4">
                    <x-logo class="w-auto h-20 mx-auto text-primary" />
                    <h2 class="mt-2 text-2xl font-extrabold text-center text-gray-900 leading-9">
                        Daftar Akaun Baru
                    </h2>
            
                    <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                        Atau
                        <a href="{{ route('login') }}" class="font-medium text-primary focus:outline-none focus:underline transition ease-in-out duration-150 text-primary-900">
                            Log Masuk Akaun Anda
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
                                placeholder="Nama Penuh" 
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
                                placeholder="No Kad Pengenalan" 
                                required 
                                autofocus 
                                class="form-input w-full content-center text-sm px-4 py-2
                                @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" 
                            />
                        </div>

                        @error('icno')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <div class="mt-1 rounded-md shadow-sm">
                            <input 
                                wire:model.lazy="icno" 
                                id="icno" 
                                type="text" 
                                placeholder="Kad Pengenalan" 
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
                        <div class="mt-1 rounded-md shadow-sm">
                            <input 
                                wire:model.lazy="email" 
                                id="email" 
                                type="email"
                                placeholder="Alamat E-mel"  
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
                                placeholder="Kata Laluan"  
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
                                placeholder="Pengesahan Kata Laluan"   
                                required 
                                class="form-input w-full content-center text-sm px-4 py-2"
                            />
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="text-sm flex justify-center w-full p-2 font-semibold text-gray-100 border-2 border-primary-900 rounded-md  bg-primary-900 hover:bg-primary-800 focus:outline-none">
                                Daftar
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

