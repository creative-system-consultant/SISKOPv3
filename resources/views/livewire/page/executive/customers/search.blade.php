<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl"> Search Customer </h1>
    <x-general.card class="p-6 mt-4 bg-white rounded-md shadow-md">
        <div>
            <div class="flex flex-wrap space-x-0 space-y-4 sm:space-x-4 sm:space-y-0">
                <div class="w-full sm:w-64">
                    <x-form.dropdown 
                        label="Search By"
                        value=""
                        name="searchby" 
                        id="searchby"
                        mandatory=""
                        disable=""
                        default="yes"  
                        wire:model="searchby"
                    >
                        <option value="name">Name</option>
                        <option value="icno">Identity No</option>
                    </x-form.dropdown>
                    @error('searchby')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:w-96">
                    <x-form.input 
                        label="Search" 
                        name="search" 
                        value="" 
                        mandatory=""
                        disable=""
                        type="text" 
                        wire:model="search"
                    />
                </div>
                <div class="flex items-center justify-center pt-0 sm:pt-4">
                    <button wire:click="search" type="submit" class="p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Search
                    </button>
                </div>
            </div>
        </div>
        <div class="pt-6 rounded-md">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Search Result</h2>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left " value="No" sort="" />
                    <x-table.table-header class="text-left " value="Name" sort="" />
                    <x-table.table-header class="text-left" value="IC No" sort="" />
                    <x-table.table-header class="text-left" value="Action" sort="" />
                </x-slot>
                <x-slot name="tbody">
                @forelse ($customers as $customer)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $loop->iteration }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $customer->name }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $customer->icno }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            <a href="{{route('customer.edit',$customer->uuid)}}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                <x-heroicon-s-pencil-alt class="w-4 h-4 mr-2"/>
                                Edit
                            </a>
                        </x-table.table-body>
                    </tr>
                @empty
                <x-table.table-body colspan="3" class="text-center">
                        No Data
                    </a>
                </x-table.table-body>
                @endforelse
                </x-slot>
            </x-table.table>
        </div>
    </x-general.card>
</div>
