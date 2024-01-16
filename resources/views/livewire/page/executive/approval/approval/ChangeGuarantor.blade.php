<div>
    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Change Guarantor Information</h2>
    @foreach ($Application->details as $item)
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-2 space-y-4 lg:items-end">
            <x-form.input-tag
                label="{{$loop->iteration}}. Old Guarantor Name"
                type="text"
                name=""
                value="{{ $item->old_jamin_name  }}"
                leftTag=""
                rightTag=""
                mandatory=""
                disable="true"
            />
            <x-form.input-tag
                label="{{$loop->iteration}}. Old Guarantor Identity No"
                type="text"
                name=""
                value="{{ $item->old_jamin_icno  }}"
                leftTag=""
                rightTag=""
                mandatory=""
                disable="true"
            />
            <x-form.input-tag
                label="{{$loop->iteration}}. New Guarantor Name"
                type="text"
                name=""
                value="{{ $item->new_jamin_name  }}"
                leftTag=""
                rightTag=""
                mandatory=""
                disable="true"
            />
            <x-form.input-tag
                label="{{$loop->iteration}}. New Guarantor Identity No"
                type="text"
                name=""
                value="{{ $item->new_jamin_icno  }}"
                leftTag=""
                rightTag=""
                mandatory=""
                disable="true"
            />
        </div>
    @endforeach

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
