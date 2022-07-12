<div class="px-4 py-2 mb-1 bg-gray-900 rounded-lg">
    <div class="flex items-center justify-between text-white">
        <h1 class="text-base">{{$title}}</h1>
        @if($route == '')
            <div class="p-1">
                <div class="w-4 h-4 text-gray-900"></div>
            </div>
        @else
            <a href="{{$route}}" class="p-1 bg-white rounded-full ">
                <x-heroicon-o-arrow-left class="w-4 h-4 text-gray-900" />
            </a>
        @endif
    </div>
</div>