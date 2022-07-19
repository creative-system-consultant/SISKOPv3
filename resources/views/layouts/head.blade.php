<!DOCTYPE html>
<html x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name') }}</title>

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/logo.png')}}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}?v=@php echo date('ymdgis') @endphp">

        <!-- Swall css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.4/dist/sweetalert2.min.css">

        <!-- animation -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- apexChart css -->
        <link rel="stylesheet" href="{{ asset('dist/apexcharts.css')}}" />

        <script src="{{ asset('js/init-alpine.js')}}"></script>
        <!-- apexChart js -->
        <script src="{{ asset('dist/apexcharts.min.js')}}"></script>

        <!-- alpine js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- jquery js -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Scripts -->
        <script src="{{ url(mix('js/app.js')) }}" defer></script>
        @livewireStyles
        @powerGridStyles
    </head>

    <body
        x-data="{'darkMode': false,profile:false}"
        x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
        $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))">
        <div class="flex h-screen" :class="{ 'overflow-hidden': isSideMenuOpen , 'dark': darkMode === true}">
            @include('layouts.sidebar.desktop')
            @include('layouts.sidebar.mobile')
            <div class="flex flex-col flex-1 w-full overflow-y-auto bg-gray-50 dark:bg-gray-800">
                @include('layouts.sidebar.topbar')
                {{-- content --}}
                @yield('content')
            </div>
        </div>

        @if (session('error'))
            <x-swall.error  message="{{ session('message') }}"/>
        @elseif (session('info'))
            <x-swall.info  message="{{ session('message') }}"/>
        @elseif (session('success'))
            <x-swall.success message="{{ session('message') }}"/>
        @elseif (session('warning'))
            <x-swall.warning  message="{{ session('message') }}"/>
        @endif
        @livewireScripts
        @powerGridScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.4/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
            window.addEventListener('swal',function(e){Swal.fire(e.detail);});
        </script>
        @stack('js')
    </body>
</html>
