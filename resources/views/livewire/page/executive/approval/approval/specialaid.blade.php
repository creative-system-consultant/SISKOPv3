<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Special Aid Information</h2>
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-3 lg:col-span-3 xl:col-span-3">
        <x-form.input-tag
            label="Type of Special Aid"
            type="text"
            name=""
            value="{{ $Application->specialAidType->name  }}"
            {{-- value="" --}}
            leftTag=""
            rightTag=""
            mandatory=""
            disable="true"
        />
    </div>
    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-3 lg:col-span-3 xl:col-span-3">
        <x-form.input-tag
            label="Amount Applied"
            type="text"
            name="apply_amt"
            value="{{ $Application->apply_amt ?? '0.00' }}"
            {{-- value="" --}}
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="true"
        />
    </div>
    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-3 lg:col-span-3 xl:col-span-3">
        <x-form.input-tag
            label="Amount Approved"
            type="text"
            name="Application.approved_amt"
            value="{{ $Application->apply_amt ?? '0.00' }}"
            leftTag="RM"
            rightTag=""
            mandatory=""
            disable="{{ $disable }}"
            wire:model="Application.approved_amt"
        />
    </div>
    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-3 lg:col-span-3 xl:col-span-3">
        <x-form.input-tag
            label="Event Date"
            type="date"
            name="Application.event_date"
            value=""
            leftTag=""
            rightTag=""
            mandatory=""
            disable=""
            wire:model="events_date"
        />
    </div>
</div>

<div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3" >
    
    <div>
        <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
            View Document
        </label>
        @forelse ($Application->files as $doc)
            <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                View
            </a>
        @empty
            <h2 class="mb-4 ml-4 text-base border-gray-300">No Document Uploaded</h2>
        @endforelse
    </div>
</div>


