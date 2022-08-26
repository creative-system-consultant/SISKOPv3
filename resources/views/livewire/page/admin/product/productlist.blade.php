<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl"> </h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        Product Dashboard
    </div>
    <div class="p-4 mt-4">
        <a href="{{route('product.create')}}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
            <x-heroicon-o-plus-circle class="w-4 h-4 mr-2" />
            New Product
        </a>
    </div>
    <div class="p-4 bg-white rounded-md shadow-md grid grid-cols-1 gap-10">
        <div>
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                @foreach ( $Product as $list )
                    <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                        <div>
                            <div class="flex justify-center pt-4">
                                <x-logo class="w-auto h-8" />
                            </div>
                            <div class="text-sm font-bold mt-2 flex items-center justify-center space-x-2"> {{ $list->name }} </div>
                            <div class="font-bold text-red mt-2 flex items-center justify-center space-x-2"> <x-heroicon-o-presentation-chart-line -alt class="w-4 h-4 mr-2"/> {{ $list->profit_rate }}% p.a. </div>
                            <div class="flex items-center justify-center space-x-2"> Profit Rate </div>
                            <div class="font-bold text-red mt-2 flex items-center justify-center space-x-2"> <x-heroicon-o-currency-dollar -alt class="w-4 h-4 mr-2"/> {{ $list->amt_max }} </div>
                            <div class="flex items-center justify-center space-x-2"> Maximum Financing </div>
                            <div class="mt-4 flex items-center justify-center space-x-2">
                                <div x-data="{open:false}">
                                    <button 
                                        @click="open = true" 
                                        type="button" 
                                        class="flex items-center p-2 text-sm text-white rounded-md bg-primary-800 hover:bg-primary-900 focus:outline-none">
                                        Product Info
                                    </button>
                                    <x-modal.modal 
                                        modalActive="open" 
                                        title="Product Info" 
                                        modalSize="xl" 
                                        closeBtn="yes"
                                    >
                                        <div class="p-4">
                                            <div>
                                                <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                                                    <div>
                                                        <div class="font-bold text-red mt-2 flex items-center justify-center space-x-2"> <x-heroicon-o-identification -alt class="w-5 h-5 mr-2"/> Product Characteristic </div>
                                                        <div class="text-sm mt-2 flex items-center justify-center space-x-2"> Duration of Approval</div>
                                                        <div class="font-bold text-red flex items-center justify-center space-x-2">  </div>
                                                        <div class="text-sm mt-2 flex items-center justify-center space-x-2"> Processing Fee Rates </div>
                                                        <div class="font-bold text-red flex items-center justify-center space-x-2">  </div>
                                                        <div class="text-sm mt-2 flex items-center justify-center space-x-2"> Highest Payout </div>
                                                        <div class="font-bold text-red flex items-center justify-center space-x-2">  </div>
                                                        <div class="text-sm mt-2 flex items-center justify-center space-x-2"> Profit Rate </div>
                                                        <div class="font-bold text-red flex items-center justify-center space-x-2"> {{ $list->profit_rate }}% p.a. </div>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-red mt-2 flex items-center justify-center space-x-2"> <x-heroicon-o-clipboard-check -alt class="w-5 h-5 mr-2"/> Eligibility </div>
                                                        <div class="text-sm mt-2 flex items-center justify-center space-x-2"> Minimum Wage Scale </div>
                                                        <div class="font-bold text-red flex items-center justify-center space-x-2">  </div>
                                                        <div class="text-sm mt-2 flex items-center justify-center space-x-2"> Employment Qualifications</div>
                                                        <div class="font-bold text-red flex items-center justify-center space-x-2">  </div>
                                                        <div class="text-sm mt-2 flex items-center justify-center space-x-2"> Minimum Age Eligibility </div>
                                                        <div class="font-bold text-red flex items-center justify-center space-x-2">  </div>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-red mt-2 flex items-center justify-center space-x-2"> <x-heroicon-o-document-text -alt class="w-5 h-5 mr-2"/> Supporting Documents Required </div>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-red mt-2 flex items-center justify-center space-x-2"> <x-heroicon-o-dots-circle-horizontal -alt class="w-5 h-5 mr-2"/> Other Info </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </x-modal.modal>
                                </div>
                                <p> <a href="{{route('product.edit', $list->id)}}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                    <x-heroicon-s-pencil-alt class="w-4 h-4 mr-2"/>
                                    Edit
                                </a> </p>
                            </div>
                            {{-- <div class="flex items-center w-full">
                                <label for="your-id" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input 
                                            type="checkbox" 
                                            id="your-id" 
                                            class="sr-only"
                                            {{-- wire:click="funtionInLivewire(your-id)" 
                                        >
                                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                    </div>
                                </label>
                            </div> --}}
                        </div>
                    </x-general.card>
                @endforeach
            </div>
        </div>
    </div>
</div>