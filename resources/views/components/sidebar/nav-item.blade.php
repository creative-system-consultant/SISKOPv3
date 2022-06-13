
<li onclick="loading()" class="relative px-4 py-2 ">
    <div class="bg-gray-100 flex justify-center px-2 py-2 rounded-md shadow-sm">
        <a class="inline-flex items-center w-full lg:text-sm text-xs font-semibold uppercase cursor-pointer
            @if(Route::current()->uri == $uri)
            text-primary-800 rounded-lg 
            transform
            @else 
            text-gray-600 hover:text-primary-800
            @endif"
            href="{{$route}}">
            {{$slot}}
            <span class="ml-4 uppercase">{{$title}}</span>
        </a>
    </div>
</li>