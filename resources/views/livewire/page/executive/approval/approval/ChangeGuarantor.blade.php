<div>
    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Special Aid Information</h2>
    <div class="mt-2">
        <x-table.table>
            <x-slot name="thead">
                <tr  class="">
                    <th  colspan="3" class="px-6 py-3 border  text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center bg-primary-50" >
                        Old Guarantor 
                    </th>
                    <th  colspan="3" class="px-6 py-3 border text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center bg-primary-100" >
                        New Guarantor
                    </th>
                </tr>
                <tr>
                    <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                        No
                    </th>
                    <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                        Name
                    </th>
                    <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                        NRIC
                    </th>
                    <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                        No
                    </th>
                    <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                        Name
                    </th>
                    <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                        NRIC
                    </th>
                </tr>
                
            </x-slot>
            <x-slot name="tbody">
                @forelse($Application->details as $item)
                    <tr>
                        <td  width="5%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                            {{$loop->iteration}}
                        </td>
                        <td  width="30%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                            {{$item->old_jamin_name}}
                        </td>
                        <td  width="15%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                            {{$item->old_jamin_icno}}
                        </td>

                        <td  width="5%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                            {{$loop->iteration}}
                        </td>

                        <td  width="35%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                            {{$item->new_jamin_name}}
                        </td>
                        <td  width="15%" class="px-6 py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                            {{$item->new_jamin_icno}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <x-table.table-body colspan="6" class="text-center">
                            No Data
                        </x-table.table-body>
                    </tr>
                @endforelse
            </x-slot>
        </x-table.table>
    </div>

</div>



{{-- <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3" >
    
    <div>
        <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
            Show Supporting Document
        </label>
        @forelse ($Application->files as $doc)
            <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                Show
            </a>
        @empty
            <h2 class="mb-4 ml-4 text-base border-gray-300">No Document Uploaded</h2>
        @endforelse
    </div>
</div>

 --}}
