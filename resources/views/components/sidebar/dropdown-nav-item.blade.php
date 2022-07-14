@props([
    'icon' => '',
    'title' => '',
    'uri' => '',
    'active' => '',
    'type' => '1',
])


@if($type == 1 )
<li class="relative px-4 py-2" x-data="{ {{$active}}:  @if(\Request::is($uri)) true @else false @endif }">
    <div class="flex justify-center ">
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
                <div class="px-2 py-2 bg-white rounded-md shadow-md">
                    {{ $icon }}
                </div>
                <span class="ml-4 text-xs uppercase lg:text-sm">{{$title}}</span>
            </a>
            <div class="invisible ml-4 text-xs">aa</div>
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
            class="p-2 mt-2 overflow-hidden text-xs font-medium rounded-md shadow-inner hide-element lg:text-sm bg-gradient-to-b from-primary-600 to-primary-700 "
            aria-label="submenu">
            {{$slot}}
        </ul>
    </div>
</li>
@else
<li class="relative px-4 py-1" x-data="{ {{$active}}:  @if(\Request::is($uri)) true @else false @endif }">
    <div class="flex justify-center text-white">
        <div 
            class="inline-flex items-center justify-between w-full text-lg font-semibold text-white cursor-pointer"
            x-on:click="{{$active}} = !{{$active}}">
            <div href="#" class="flex items-center text-xs uppercase lg:text-sm"">
                {{ $icon }}
                <span class="ml-2">{{$title}}</span>
            </div>
            <div>
                <span>
                    <x-heroicon-o-chevron-left x-show="!{{$active}}" class="w-4 h-4 ml-4"  style="display: none;"/>
                    <x-heroicon-o-chevron-down x-show="{{$active}}" class="w-4 h-4 ml-4"  style="display: none;"/>
                </span>
            </div>
        </div>
    </div>
    <div x-show.transition="{{$active}}" x-cloak>
        <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0"
            x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300"
            x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
            class="p-2 mt-2 ml-3  overflow-hidden text-xs font-medium border-l-[1.5px] border-white hide-element lg:text-sm "
            aria-label="submenu">
            {{$slot}}
        </ul>
    </div>
</li>
@endif