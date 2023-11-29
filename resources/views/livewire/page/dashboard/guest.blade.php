<div class="p-4">
    <h1 class="font-semibold text-lg mb-4 border-b border-gray-200 p-2">Select Registered Client</h1>
    <div class="grid grid-cols-1 gap-10">
        <div class="mt-4">
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 lg:grid-cols-3 xl:grid-cols-3">
                @forelse ($userclient as $item)
                    <x-general.card class="p-4 bg-white rounded-lg shadow-md relative">
                        <div class="flex items-center space-x-2">
                            <div class="flex justify-center items-center p-2  bg-gray-50  rounded-lg">
                                <img class="w-20 h-20  object-contain" src="{{ asset('storage/'.$item->logo_path) }}" alt="{{ $item->name2 }}">
                            </div>
                            <div>
                                <div class="flex flex-col space-y-1">
                                    <p class="text-sm leading-5 font-semibold">{{ $item->name }} - <span class="text-primary-600">{{ $item->name2 }}</span></p>
                                    <p class="text-sm text-gray-500 line-clamp-1">{{ $item->type->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end absolute bottom-0 right-0 px-2 py-1">
                            <button type="button" wire:click="select('{{ $item->uuid }}')" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                                Select
                            </button>
                        </div>
                    </x-general.card>
                @empty
                    <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                        <div>
                            <p class="my-2 text-sm">No Registered Clients</p>
                        </div>
                    </x-general.card>
                @endforelse
            </div>
        </div>
    </div>
    <div>
        <h1 class="font-semibold text-lg mt-6 border-b border-gray-200 p-2">Register New Client</h1>
        <div>
            @php $lasttype = null; @endphp
            @forelse ($clients as $item)
                @if ($lasttype != $item->type_id)
                    @if ($lasttype !== null)
                        </div> <!-- Close previous grid if not the first loop -->
                    @endif
                    <div>
                        <h2 class="text-base font-semibold md:text-xl mt-6">{{ $item->type->description }}</h2>
                    </div>
                    <div class="grid grid-cols-1  md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-2 mt-4">
                @endif
                <x-general.card class="p-4 bg-white rounded-lg shadow-md relative pb-10">

                    <div x-data="{ openInfo{{ $loop->iteration }}:false, openRegister{{ $loop->iteration }}:false }">
                        <div class="flex flex-col">
                            <div class="flex justify-center items-center  mb-4 bg-gray-50  rounded-lg">
                                <img class="w-28 h-28 object-contain" src="{{ asset('storage/'.$item->logo_path) }}" alt="{{ $item->name2 }}">
                            </div>
                            <div>
                                <div class="flex flex-col space-y-1">
                                    <p class="text-sm leading-5 font-semibold">{{ $item->name }} - <span class="text-primary-600">{{ $item->name2 }}</span></p>
                                    <p class="text-sm text-gray-500 line-clamp-1">{{ $item->description }}</p>
                                    <button type="button" class="text-sm font-semibold text-blue-500 hover:text-blue-600 flex w-24"
                                        @click="openInfo{{ $loop->iteration }} = true">
                                        Read more
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="absolute bottom-0 right-0 p-1">
                            <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 hover:bg-green-600 rounded-md focus:outline-none" 
                                @click="openRegister{{ $loop->iteration }} = true">
                                Register
                            </button>
                        </div>

                        <x-modal.modal
                            modalActive="openInfo{{ $loop->iteration }}"
                            title="{{ $item->name2 }}"
                            modalSize="xl"
                            closeBtn="yes"
                            >
                            <div class="p-4">
                                {{ $item->description }}
                            </div>
                        </x-modal.modal>

                        <x-modal.modal
                            modalActive="openRegister{{ $loop->iteration }}"
                            title="{{ $item->name2 }}"
                            modalSize="xl"
                            closeBtn="yes"
                            >
                            <div class="p-4 text-center">
                                <p>Are you sure you want to register to be a member of this COOP?</p>
                                <div class="flex items-center justify-center mt-2">
                                    <button type="button" wire:click="reg('{{ $item->uuid }}')" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </x-modal.modal>
                    </div>
                </x-general.card>
                
                @php $lasttype = $item->type_id; @endphp
            @empty
                <p>No Registered Clients</p>
            @endforelse
            @if ($lasttype !== null)
                </div> <!-- Ensure this div is closed if there were clients -->
            @endif
        </div>
    </div>
    

    
    </div>
</div>
@push('js')
    <script>
        var darkModeColor;
        if(localStorage.getItem('darkMode') == 'true'){
            darkModeColor = '#ffffff';
        }else{
            darkModeColor = '#000000';
        }
    </script>
@endpush
