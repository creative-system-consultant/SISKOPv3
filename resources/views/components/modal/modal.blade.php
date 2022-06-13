@props([
    'id' => '',
    'close' => 'false',
    'autoClose' => 'false',
    'width' => '2xl',
    'title' => '',
])

<div
    class="fixed inset-0 z-30 flex flex-col items-center justify-end px-5 overflow-y-auto bg-gray-800 bg-opacity-50 sm:justify-start sm:px-0"
    x-data="{modal:false}"
    x-show="modal"
    x-on:modal-overlay.window="if ($event.detail.id == '{{ $id }}') modal = true"
    x-on:close-modal-overlay.window="if ($event.detail.id == '{{ $id }}') modal = false"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-500"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    {!! $autoClose == "true" ? 'x-on:click="modal=false, bsd(false)"' : '' !!}
    x-cloak>
	<div
        class="w-full mb-5 transition-all transform sm:mt-20 sm:mb-20 sm:max-w-{{ $width }}"
        x-show="modal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4 sm:translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4 sm:translate-y-4">
		<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-xl relative overflow-hidden']) }}>
            <div class="p-4 flex justify-between w-full items-center border-b-2">
                <p class="text-xl font-semibold">{{$title}}</p>
                @if ($close == "true")
                    <button type="button" class="flex items-center justify-center w-8 h-8 transition duration-300 ease-in-out rounded-lg bg-primary-800 text-white hover:bg-primary-900 focus:outline-none z-10 p-2" 
                    x-on:click="modal=false, bsd(false)">
                        <x-heroicon-o-x class="w-5 h-5"/>
                    </button>
                @endif
            </div>
            {{ $slot }}
        </div>
	</div>
</div>
