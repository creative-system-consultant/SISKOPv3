
<li onclick="loading()" class="relative px-4 py-2 ">
    <div class="flex justify-center">
        <a class="inline-flex items-center w-full lg:text-sm text-xs font-semibold uppercase cursor-pointer
            hover:text-primary-800
            @if(Route::current()->uri == $uri)
            text-primary-800 rounded-lg dark:text-primary-600
            @else 
            text-gray-600 dark:text-white dark:hover:text-primary-600
            @endif"
            href="{{$route}}">
            <div class="px-2 py-2 bg-white rounded-md shadow-md dark:bg-gray-900">
                {{$slot}}
            </div>
            <span class="ml-4 uppercase">{{$title}}</span>
        </a>
    </div>
</li>