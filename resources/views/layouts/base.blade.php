<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @hasSection('title')
            <title>@yield('title')</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="icon"sizes="16x16"  type="image/png" href="{{ asset('img/logo.png')}}">
        
        

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ url(mix('js/app.js')) }}?v=@php echo date('ymdgis') @endphp" defer></script>

        <!-- tippy js -->
        <script src="{{ asset('js/popper.min.js')}}"></script>
        <script src="{{ asset('js/tippy.min.js')}}"></script>

    </head>

    <style>
        .myfont{
            font-family: 'Spartan', sans-serif;
        }
    </style>

    <body>
        @yield('body')

        @livewireScripts
    </body>

    <script>
        tippy('.tooltipbtn', {
            content:(reference)=>reference.getAttribute('data-title'),
            onMount(instance) {
                instance.popperInstance.setOptions({
                placement :instance.reference.getAttribute('data-placement')
                });
            },
            allowHTML: true,
        });
    </script>
</html>
