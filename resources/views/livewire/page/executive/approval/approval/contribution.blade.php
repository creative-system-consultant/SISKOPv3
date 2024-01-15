<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
    <x-form.input-tag
        label="Add Contribution applied"
        type="text"
        name="cont_apply"
        value="{{ $Application->apply_amt ?? '0.00' }}"
        placeholder="0.00"
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="true"
    />
    <x-form.input-tag
        label="Add Contribution approved"
        type="text"
        name="Application.approved_amt"
        value=""
        placeholder=""
        leftTag="RM"
        rightTag=""
        mandatory=""
        disable="{{ $disable }}"
        wire:model="Application.approved_amt"
    />
    <x-form.input
        label="Date Options"
        value="{{ $Application->start_apply == NULL ? 'One Month' : 'Starting Date' }}"
        name="cont_type"
        id="cont_type"
        mandatory=""
        disable="true"
        default="yes"
    />
    @if ( $Application->start_apply !== NULL)
        <x-form.input
            label="Start Date"
            name="start_contDate"
            value="{{ $Application->start_apply == NULL ? '' : $Application->start_apply->format('Y-m-d') }}"
            mandatory=""
            disable="true"
            type="date"
        />
    @endif
    @if ( $Application->start_apply !== NULL)
        <x-form.input
            label="Approved Start Date"
            name="start_approvedDate"
            value="{{ $Application->start_approved == NULL ? '' : $Application->start_approved->format('Y-m-d') }}"
            mandatory=""
            disable=""
            type="date"
        />
    @endif
</div>

<div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3" >
    
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
