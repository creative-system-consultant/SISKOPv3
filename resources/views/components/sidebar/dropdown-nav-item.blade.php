<li class="relative px-4 py-2" x-data="{ {{$active}}:  @if(\Request::is($uri)) true @else false @endif }">
    <div class="bg-gray-100 flex justify-center px-2 py-2 rounded-md shadow-sm">
        <div 
            class="inline-flex items-center justify-between w-full text-lg font-semibold  
            cursor-pointer
            @if(\Request::is($uri))
                text-primary-800
            @else
                text-gray-600 hover:text-primary-800
            @endif"
            x-on:click="{{$active}} = !{{$active}}">
            <a href="#" class="inline-flex items-center text-sm font-semibold  
                @if(\Request::is($uri))
                    text-primary-800
                @else
                    text-gray-600 hover:text-primary-800
                @endif">
                {{ $icon }}
                <span class="ml-4 uppercase lg:text-sm text-xs">{{$title}}</span>
            </a>
            <div class="ml-4 text-xs invisible">aa</div>
            <a>
                <span>
                    <x-heroicon-o-chevron-left x-show="!{{$active}}" class="w-4 h-4 ml-4"  style="display: none;"/>
                    <x-heroicon-o-chevron-down x-show="{{$active}}" class="w-4 h-4 ml-4"  style="display: none;"/>
                </span>
            </a>
        </div>
    </div>
    <div x-show.transition="{{$active}}" x-cloak>
        <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0"
            x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300"
            x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
            class="hide-element p-1 mt-2 space-y-2 overflow-hidden lg:text-sm text-xs font-medium rounded-md shadow-inner bg-primary-800 "
            aria-label="submenu">
            {{$slot}}
        </ul>
    </div>
</li>