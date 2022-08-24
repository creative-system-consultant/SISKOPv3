<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl"> </h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <p>Product Dashboard</p>
    </x-general.card>
    <x-general.card class="grid grid-cols-1 gap-10 p-4 mt-5 bg-white rounded-md shadow-md ">
        <div>
            <div class="mb-5">
                <a href="{{route('product.create')}}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
                    <x-heroicon-o-plus-circle class="w-4 h-4 mr-2" />
                    New Product
                </a>
            </div>
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                @foreach ( $Product as $list )
                    <x-general.card class="p-4 bg-white border rounded-lg shadow-md">
                        <div>
                            <div class="flex justify-center pt-4">
                                <x-logo class="w-auto h-12" />
                            </div>
                            <p class="flex items-center justify-center mt-2 space-x-2 text-sm font-bold"> {{ $list->name }} </p>
                            <p class="flex items-center justify-center mt-2 space-x-2 font-bold text-red-500"> <x-heroicon-o-presentation-chart-line -alt class="w-4 h-4 mr-2"/> {{ $list->profit_rate }}% p.a. </p>
                            <p class="flex items-center justify-center space-x-2"> Profit Rate </p>
                            <p class="flex items-center justify-center mt-2 space-x-2 font-bold text-red-500"> <x-heroicon-o-currency-dollar -alt class="w-4 h-4 mr-2"/> {{ $list->amt_max }} </p>
                            <p class="flex items-center justify-center space-x-2"> Maximum Financing </p>
                            <div class="flex items-center justify-center mt-4 space-x-2">
                                <div x-data="{openModal:false}">
                                    <button 
                                        @click="openModal = true" 
                                        type="button" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white rounded bg-primary-700 hover:bg-primary-600">
                                        <x-heroicon-s-information-circle class="w-4 h-4 mr-2"/>
                                        More Info
                                    </button>
                                    <x-modal.modal 
                                        modalActive="openModal" 
                                        title="Product Info" 
                                        closeBtn="yes"
                                        modalSize="7xl"
                                    >
                                        <div class="p-4">
                                            <div>
                                                <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                                                    <div>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 font-bold"> <x-heroicon-o-identification -alt class="w-5 h-5 mr-2"/> Product Characteristic </p>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 text-sm"> Duration of Approval </p>
                                                        <p class="flex items-center justify-center space-x-2 font-bold text-red-500"> 1 Day </p>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 text-sm"> Processing Fee Rates </p>
                                                        <p class="flex items-center justify-center space-x-2 font-bold text-red-500"> RM 250.00 </p>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 text-sm"> Highest Payout </p>
                                                        <p class="flex items-center justify-center space-x-2 font-bold text-red-500"> 5.00 % </p>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 text-sm"> Profit Rate </p>
                                                        <p class="flex items-center justify-center space-x-2 font-bold text-red-500"> {{ $list->profit_rate }}% p.a. </p>
                                                    </div>
                                                    <div>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 font-bold"> <x-heroicon-o-clipboard-check -alt class="w-5 h-5 mr-2"/> Eligibility </p>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 text-sm"> Minimum Wage Scale </p>
                                                        <p class="flex items-center justify-center space-x-2 font-bold text-red-500"> RM .00 </p>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 text-sm"> Employment Qualifications</p>
                                                        <p class="flex items-center justify-center space-x-2 font-bold text-red-500">  </p>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 text-sm"> Minimum Age Eligibility </p>
                                                        <p class="flex items-center justify-center space-x-2 font-bold text-red-500">  </p>
                                                    </div>
                                                    <div>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 font-bold"> <x-heroicon-o-document-text -alt class="w-5 h-5 mr-2"/> Supporting Documents Required </p>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 text-sm"> Copy of Identity Card (Front and Back) </p>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 text-sm"> Copy of Latest Salary Statement (with employer's confirmation stamp) </p>
                                                        <div>
                                                            <ul>
                                                                <li>  </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="flex items-center justify-center mt-2 space-x-2 font-bold"> <x-heroicon-o-dots-circle-horizontal -alt class="w-5 h-5 mr-2"/> Other Info </p>
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
    </x-general.card>
</div>