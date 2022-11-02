<li onclick="loading()" class="px-2 text-white transition-colors duration-150">
    <div class="px-1 rounded-lg @if(Route::current()->uri == $uri) text-black bg-white @endif">
        <div class="flex items-center px-1 py-1">
            {{ $icon }}
            <a class="w-full ml-2 text-xs font-semibold uppercase lg:text-sm" {{ $attributes }}>
                {{ $title }}
            </a>
        </div>
    </div>
</li>
