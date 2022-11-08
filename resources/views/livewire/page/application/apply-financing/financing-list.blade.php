<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl"> Apply > Financing</h1>
    <div class="grid grid-cols-1 gap-10 p-4 mt-4 bg-white rounded-md shadow-md">
        <div>
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                @forelse ( $Product as $list )
                    <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                        <div>
                            <div class="flex justify-center pt-4">
                                <x-logo class="w-auto h-8" />
                            </div>
                            <div class="flex items-center justify-center mt-2 space-x-2 text-sm font-bold"> {{ $list->name }} </div>
                            <div class="flex items-center justify-center mt-2 space-x-2 font-bold text-red"> <x-heroicon-o-presentation-chart-line -alt class="w-4 h-4 mr-2"/> {{ $list->profit_rate }}% p.a. </div>
                            <div class="flex items-center justify-center space-x-2"> Profit Rate </div>
                            <div class="flex items-center justify-center mt-2 space-x-2 font-bold text-red"> <x-heroicon-o-currency-dollar -alt class="w-4 h-4 mr-2"/> {{ $list->amt_max }} </div>
                            <div class="flex items-center justify-center space-x-2"> Maximum Financing </div>
                            <div class="flex items-center justify-center mt-4 space-x-2">
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
                                        modalSize="7xl"
                                        closeBtn="yes"
                                    >
                                        <div class="p-4">
                                            <div>
                                                <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                                                    <div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 font-bold text-red-500"> <x-heroicon-o-identification -alt class="w-5 h-5 mr-2"/> Product Characteristic </div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 text-sm"> Duration of Approval</div>
                                                        <div class="flex items-center justify-center space-x-2 font-bold text-red">  </div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 text-sm"> Processing Fee Rates </div>
                                                        <div class="flex items-center justify-center space-x-2 font-bold text-red">  </div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 text-sm"> Highest Payout </div>
                                                        <div class="flex items-center justify-center space-x-2 font-bold text-red">  </div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 text-sm"> Profit Rate </div>
                                                        <div class="flex items-center justify-center space-x-2 font-bold text-red"> {{ $list->profit_rate }}% p.a. </div>
                                                    </div>
                                                    <div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 font-bold text-red-500"> <x-heroicon-o-clipboard-check -alt class="w-5 h-5 mr-2"/> Eligibility </div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 text-sm"> Minimum Wage Scale </div>
                                                        <div class="flex items-center justify-center space-x-2 font-bold text-red">  </div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 text-sm"> Employment Qualifications</div>
                                                        <div class="flex items-center justify-center space-x-2 font-bold text-red">  </div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 text-sm"> Minimum Age Eligibility </div>
                                                        <div class="flex items-center justify-center space-x-2 font-bold text-red">  </div>
                                                    </div>
                                                    <div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 font-bold text-red-500"> <x-heroicon-o-document-text -alt class="w-5 h-5 mr-2"/> Supporting Documents Required </div>
                                                    </div>
                                                    <div>
                                                        <div class="flex items-center justify-center mt-2 space-x-2 font-bold text-red-500"> <x-heroicon-o-dots-circle-horizontal -alt class="w-5 h-5 mr-2"/> Other Info </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </x-modal.modal>
                                </div>
                                <p> <a href="{{ route('financing.apply', $list->uuid) }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                    <x-heroicon-s-pencil-alt class="w-4 h-4 mr-2"/>
                                    Apply
                                </a> </p>
                            </div>
                        </div>
                    </x-general.card>
                @empty
                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <div class="flex justify-center pt-4">
                            <x-logo class="w-auto h-8" />
                        </div>
                        <div class="text-sm font-bold mt-2 flex items-center justify-center space-x-2"> TIADA PRODUK DIDAFTARKAN</div>
                        <div class="font-bold text-red mt-2 flex items-center justify-center space-x-2"> <x-heroicon-o-presentation-chart-line -alt class="w-4 h-4 mr-2"/> % p.a. </div>
                        <div class="flex items-center justify-center space-x-2"> Profit Rate </div>
                        <div class="font-bold text-red mt-2 flex items-center justify-center space-x-2"> <x-heroicon-o-currency-dollar -alt class="w-4 h-4 mr-2"/>  </div>
                        <div class="flex items-center justify-center space-x-2"> Maximum Financing </div>
                        <div class="mt-4 flex items-center justify-center space-x-2">
                            <div x-data="{open:false}">
                                <button
                                    type="button"
                                    class="flex items-center p-2 text-sm text-white rounded-md bg-primary-800 hover:bg-primary-900 focus:outline-none">
                                    Product Info
                                </button>
                            </div>
                            <p> <button class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                <x-heroicon-s-pencil-alt class="w-4 h-4 mr-2"/>
                                Apply
                            </button> </p>
                        </div>
                    </div>
                </x-general.card>
                @endforelse
            </div>
        </div>
    </div>
</div>