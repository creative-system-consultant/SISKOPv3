<div class="p-4">
    <h1 class="p-2 mb-4 text-lg font-semibold border-b border-gray-200">Select Registered Client</h1>
    <div class="grid grid-cols-1 gap-2">
        <div class="mt-4">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 lg:grid-cols-4 xl:grid-cols-4">
                @forelse ($userclient as $item)
                    <x-general.card class="relative p-4 bg-white rounded-lg shadow-md">
                        <div class="flex items-center space-x-2">
                            <div class="flex items-center justify-center p-2 rounded-lg bg-gray-50">
                                <img class="object-contain w-10 h-10" src="{{ asset('storage/'.$item->logo_path) }}" alt="{{ $item->name2 }}">
                            </div>
                            <div>
                                <div class="flex flex-col space-y-1">
                                    <p class="text-sm font-semibold leading-5 text-primary-600">{{ $item->name2 }} - <span class="text-gray-600">{{ $item->type->description }}</span></p>
                                </div>
                            </div>
                            <div class="absolute p-1 top-7 right-2">
                                <button type="button" wire:click="select('{{ $item->uuid }}')" class="flex items-center justify-center px-4 py-1 text-xs font-semibold text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none">
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
    <div x-data="{active : 1}">
        <h1 class="p-2 mt-6 text-lg font-semibold border-b border-gray-200">Register New Client</h1>
        <div>
            <div class="flex bg-white rounded-md">
                @foreach ($clients->groupBy('type_id') as $typeId => $clientsByType)
                    <x-tab.title name="{{ $typeId }}" livewire="">
                        <div class="flex items-center">
                            <x-heroicon-o-newspaper class="w-5 h-5 mr-2"/>
                            <p class="text-xs">{{ $clientsByType->first()->type->description }}</p>
                        </div>
                    </x-tab.title>
                @endforeach
            </div>
        </div>
        <div class="mt-4">
            @foreach ($clients->groupBy('type_id') as $typeId => $clientsByType)
                <x-tab.content name="{{ $typeId }}" x-cloak>
                    <div class="grid grid-cols-1 gap-2 mt-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 2xl:grid-cols-4">
                        @forelse ($clientsByType as $item)
                            <x-general.card class="relative p-4 bg-white rounded-lg shadow-md ">
                                <div x-data="{ openInfo{{ $loop->iteration }}:false, openRegister{{ $loop->iteration }}:false}">
                                    <div >
                                        <div class="flex items-center space-x-2">
                                            <div class="flex items-center justify-center p-2 rounded-lg bg-gray-50">
                                                <img class="object-contain w-10 h-10" src="{{ asset('storage/'.$item->logo_path) }}" alt="{{ $item->name2 }}">
                                            </div>
                                            <div>
                                                <div class="flex flex-col space-y-1">
                                                    <p class="text-sm font-semibold leading-5 text-primary-600">{{ $item->name2 }}</p>
                                                </div>
                                            </div>

                                            @php
                                            $appliedClientIds = auth()->user()->membership_apply->pluck('client_id')->toArray();
                                            @endphp

                                            @if(!in_array($item->id, $appliedClientIds))
                                                <div class="absolute p-1 top-7 right-2">
                                                    <button type="button" class="flex items-center justify-center px-4 py-1 text-xs font-semibold text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none"
                                                        @click="openRegister{{ $loop->iteration }} = true">
                                                        Register
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <div class="flex flex-col">
                                            <div class="relative flex flex-col space-y-1">
                                                <p class="text-sm font-semibold leading-5">{{ $item->name }}</p>
                                                <div>
                                                    <div class="float-right">
                                                        <div class="text-sm font-semibold text-blue-500 cursor-pointer hover:text-blue-600"
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
                        @empty
                            <p class="my-2 text-sm">No Register New Client</p>
                        @endforelse
                    </div>
                </x-tab.content>
            @endforeach
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
