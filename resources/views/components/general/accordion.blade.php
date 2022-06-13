<ul class="mb-1 border rounded-md cursor-pointer" {{ $attributes }}>
    <li class="flex flex-col align-center">
        <div class="w-full px-2 py-2  text-left bg-{{$bg}} rounded-md"
            @click="{{$active}} !== {{$tab}} ? {{$active}} = {{$tab}} : {{$active}} = null">
            <div class="flex items-center justify-between">
                {{$title}}
                <div class="flex items-center p-2 mx-4  bg-primary-800 rounded-full text-white">
                    <x-heroicon-o-chevron-left x-show="{{$active}} !== {{$tab}}" class="w-4 h-4 " x-cloak/>
                    <x-heroicon-o-chevron-down x-show="{{$active}} == {{$tab}}" class="w-4 h-4" x-cloak/>
                </div>
            </div>
        </div>
        <div x-show="{{$active}} == {{$tab}}" class="px-2 py-4 bg-white " x-cloak>
            {{$content}}
        </div>
    </li>
</ul>
