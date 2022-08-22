<x-form.basic-form wire:submit.prevent="submit" class="p-4">
    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Document List</h2>

    @foreach ($refdocument as $key => $list)
    <div class="mt-4 grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
            <div class="flex items-center w-full">
                <label for="{{ $list->code }}" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input 
                            type="checkbox" 
                            id="{{ $list->code }}" 
                            class="sr-only"
                            @php
                                $item = $this->membership->documents()->where('type',$list->code)->first();
                            @endphp
                            @if ( $item != NULL)
                                @if ($item->status == 1)
                                checked
                                @else
                                @endif
                            @else
                            @endif
                            wire:click="enableDoc('{{ $list->code }}','{{ $list->description }}')"
                        >
                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
            {{ $list->description }}
        </div>
    </div> 
    @endforeach
    

</x-form.basic-form>