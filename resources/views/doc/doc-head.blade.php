<!DOCTYPE html>
<html x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name') }}</title>

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/logo.png')}}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}?v=@php echo date('ymdgis') @endphp">

        <!-- Swall css -->
        <link rel="stylesheet" href="{{ asset('dist/sweetalert2.min.css') }}">

        <!-- animation -->
        <link rel="stylesheet" href="{{ asset('dist/animate.min.css') }}"/>

        <!-- apexChart css -->
        <link rel="stylesheet" href="{{ asset('dist/apexcharts.css')}}" />

        <script src="{{ asset('js/init-alpine.js')}}"></script>
        <!-- apexChart js -->
        <script src="{{ asset('dist/apexcharts.min.js')}}"></script>

        <!-- alpine js -->
        <script defer src="{{ asset('dist/alpinejs3.10.3.min.js.min.js') }}"></script>

        <!-- jquery js -->
        <script src="{{ asset('dist/jquery-3.6.0.min.js') }}"></script>

        <!-- Scripts -->
        <script src="{{ url(mix('js/app.js')) }}" defer></script>

        <script src=" {{ asset('dist/highlightjs11.5.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/blade.min.js') }}"></script>
        <script>hljs.highlightAll();</script>
        <link rel="stylesheet" href="{{ asset('dist/monokai-sublime.min.css') }}">

        @livewireStyles
    </head>

    <body class="bg-gray-100">
        <div class="flex h-screen " :class="{ 'overflow-hidden': isSideMenuOpen }"  >
            <div class="flex flex-col flex-1 w-full overflow-y-auto">
                @include('doc.doc-topbar')
                {{-- content --}}
                @yield('content')
            </div>
        </div>

        @livewireScripts
        <script src="{{ asset('dist/sweetalert2.all.min.js') }}"></script>
        <script src="{{ asset('dist/summernote-lite.min.js') }}"></script>
        <script>
            window.addEventListener('swal',function(e){Swal.fire(e.detail);});
        </script>
        <script src="{{ asset('dist/ace.js') }}" type="text/javascript" charset="utf-8"></script>
        </body>
        </html>
        @stack('js')
    </body>
</html>
