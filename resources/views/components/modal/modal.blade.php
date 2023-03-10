<div
    style="display: none;"
    x-show="{{ $modalActive }}"
    x-description="Background overlay, show/hide based on modal state."
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak
    class="fixed inset-0 z-30 flex flex-col items-center justify-start px-5 overflow-y-auto bg-gray-800 bg-opacity-50 sm:px-0"
    >
	<div
        class="w-full mb-5 transition-all transform sm:mt-20 sm:mb-20 sm:max-w-{{ $modalSize }}"
        x-description="Modal panel, show/hide based on modal state."
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
		<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-xl relative overflow-hidden dark:bg-gray-700']) }}>
            <div class="flex items-center justify-between w-full p-4 border-b-2">
                <p class="text-xl font-semibold">{{ $title }}</p>
                @if (isset($closeBtn) and $closeBtn == "yes")
                    <button type="button" @if(isset($closeFn) && $closeFn != "") wire:click="{{ $closeFn }}" @endif class="z-10 flex items-center justify-center w-8 h-8 p-2 text-white transition duration-300 ease-in-out rounded-lg bg-primary-800 hover:bg-primary-900 focus:outline-none dark:bg-primary-600 dark:hover:bg-primary-600"
                    @click="{{ $modalActive }} = false">
                        <x-heroicon-o-x-mark class="w-5 h-5"/>
                    </button>
                @endif
            </div>
            {{ $slot }}
        </div>
	</div>
</div>

