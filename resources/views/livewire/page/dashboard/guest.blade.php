<div class="p-4">
    <h1 class="font-semibold text-lg mb-4 border-b border-gray-200 p-2">Select Registered Client</h1>
    <div class="grid grid-cols-1 gap-2">
        <div class="mt-4">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 lg:grid-cols-4 xl:grid-cols-4">
                @forelse ($userclient as $item)
                    <x-general.card class="p-4 bg-white rounded-lg shadow-md relative">
                        <div class="flex items-center space-x-2">
                            <div class="flex justify-center items-center p-2  bg-gray-50 rounded-lg">
                                <img class="w-10 h-10 object-contain" src="{{ asset('storage/'.$item->logo_path) }}" alt="{{ $item->name2 }}">
                            </div>
                            <div>
                                <div class="flex flex-col space-y-1">
                                    <p class="text-sm leading-5 font-semibold text-primary-600">{{ $item->name2 }} - <span class="text-gray-600">{{ $item->type->description }}</span></p>
                                </div>
                            </div>
                            <div class="absolute top-7 right-2 p-1">
                                <button type="button" wire:click="select('{{ $item->uuid }}')" class="flex items-center justify-center px-4 py-1 text-xs font-semibold text-white bg-green-500 hover:bg-green-600 rounded-md focus:outline-none">
                                    Select
                                </button>
                            </div>
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
                        <h2 class="text-base font-semibold md:text-lg mt-6">{{ $item->type->description }}</h2>
                    </div>
                    <div class="grid grid-cols-1  md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 2xl:grid-cols-4 gap-2 mt-2">
                @endif
                <x-general.card class="p-4 bg-white rounded-lg shadow-md relative ">
                    <div  x-data="{ openInfo{{ $loop->iteration }}:false, openRegister{{ $loop->iteration }}:false}">
                        <div >
                            <div class="flex items-center space-x-2">
                                <div class="flex justify-center items-center p-2  bg-gray-50 rounded-lg">
                                    <img class="w-10 h-10 object-contain" src="{{ asset('storage/'.$item->logo_path) }}" alt="{{ $item->name2 }}">
                                </div>
                                <div>
                                    <div class="flex flex-col space-y-1">
                                        <p class="text-sm leading-5 font-semibold text-primary-600">{{ $item->name2 }}</p>
                                    </div>
                                </div>
                                <div class="absolute top-7 right-2 p-1">
                                    <button type="button" class="flex items-center justify-center px-4 py-1 text-xs font-semibold text-white bg-green-500 hover:bg-green-600 rounded-md focus:outline-none" 
                                        @click="openRegister{{ $loop->iteration }} = true">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="flex flex-col">
                                <div class="flex flex-col space-y-1 relative">
                                    <p class="text-sm leading-5 font-semibold">{{ $item->name }}</p>
                                    <div>
                                        <div class="float-right">
                                            <div class="text-sm font-semibold text-blue-500 hover:text-blue-600 cursor-pointer"
                                                @click="openInfo{{ $loop->iteration }} = true">
                                                Read more
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-500 line-clamp-1">
                                            {{ $item->description }} 
                                        </p>
                                    </div>
                                </div>
                            </div>
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
                <p class="my-2 text-sm">No Register New Client</p>
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
