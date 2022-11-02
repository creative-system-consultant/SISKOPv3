<!DOCTYPE html>
<html x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name') }}</title>

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/logo.png') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}?v=@php echo date('ymdgis') @endphp">

        <!-- Swall css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.4/dist/sweetalert2.min.css">

        <!-- animation -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- apexChart css -->
        <link rel="stylesheet" href="{{ asset('dist/apexcharts.css') }}" />

        <script src="{{ asset('js/init-alpine.js') }}"></script>
        <!-- apexChart js -->
        <script src="{{ asset('dist/apexcharts.min.js') }}"></script>

        <!-- jquery js -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Scripts -->
        <script src="{{ url(mix('js/app.js')) }}" defer></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/tippy.min.js') }}"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
        <script type="text/javascript" src="https://unpkg.com/highlightjs-blade/dist/blade.min.js"></script>
        <script>hljs.highlightAll();</script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/styles/monokai-sublime.min.css">

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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.4/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
            window.addEventListener('swal',function(e){Swal.fire(e.detail);});
        </script>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/ace.js" type="text/javascript" charset="utf-8"></script>
        </body>
        </html>
        @stack('js')
    </body>
</html>
