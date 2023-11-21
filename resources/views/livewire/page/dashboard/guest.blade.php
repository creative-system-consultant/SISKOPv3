<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Select Registered Client</h1>
    <div class="grid grid-cols-1 gap-10">
        <div class="mt-4">
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                @forelse ($userclient as $item)
                    <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                        <div>
                            <p class="my-2 text-xl">{{ $item->name }}</p>
                            <p class="my-2 text-md">{{ $item->name2 }}</p>
                            <p class="my-2 text-md">{{ $item->type->description }}</p>
                            <p class="my-2"><img class="mx-auto w-auto h-30" src="{{ asset('storage/'.$item->logo_path) }}" alt="{{ $item->name2 }}"></p>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <button type="button" wire:click="select('{{ $item->uuid }}')" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                                Select
                            </button>
                        </div>
                    </x-general.card>
                @empty
                    <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                        <div>
                            <p class="my-2 text-xl">No Registered Clients</p>
                        </div>
                    </x-general.card>
                @endforelse
            </div>
        </div>
    </div>
    <h1 class="text-base font-semibold md:text-2xl mt-6">Register New Client</h1>
    <div class="grid grid-cols-1 gap-10">
        <div class="mt-4">
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                @php $lasttype = '' @endphp
                @forelse ($clients as $item)
                    @if($lasttype != $item->type_id)
                                </div>
                            </div>
                        </div>
                        <h2 class="text-base font-semibold md:text-xl mt-6">{{ $item->type->description }}</h2>
                        <div class="grid grid-cols-1 gap-10">
                            <div class="mt-4">
                                <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    @endif
                    <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                        <div>
                            <p class="my-2 text-xl">{{ $item->name }}</p>
                            <p class="my-2 text-md">{{ $item->name2 }}</p>
                            <p class="my-2"><img class="mx-auto w-auto h-20" src="{{ asset('storage/'.$item->logo_path) }}" alt="{{ $item->name2 }}"></p>
                            <p class="my-2 justify-center">{{ $item->description }}</p>
                        </div>
                        <div x-data="{ openInfo{{ $loop->iteration }}:false, openRegister{{ $loop->iteration }}:false }">
                            <div class="flex items-right space-x-2">
                                <button type="button" @click="openInfo{{ $loop->iteration }} = true" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                                    More Information
                                </button>
                                <button type="button" @click="openRegister{{ $loop->iteration }} = true" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
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
                                <div class="p-4">
                                    Are you sure you want to register to be a member of this COOP?
                                    <button type="button" wire:click="reg('{{ $item->uuid }}')" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                                        Register
                                    </button>
                                </div>
                            </x-modal.modal>
                        </div>
                    </x-general.card>
                    @php $lasttype = $item->type_id @endphp
                @empty
                    
                @endforelse
            </div>
        </div>
    </div>
    <div>
    
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
