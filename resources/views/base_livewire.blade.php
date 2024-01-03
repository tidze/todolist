<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">

    <title>@yield('APP_NAME', env('APP_NAME'))</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
    @livewireStyles
    @stack('script-head')
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/jquery-clock-timepicker.min.js') }}"></script> --}}
    <style>
        .debug-border {
            border: 1px solid tomato;
        }

        .debug-border * {
            border: 1px solid tomato;
        }

        /* For Webkit-based browsers (Chrome, Safari and Opera) */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* For IE, Edge and Firefox */
        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

     </style>
</head>

<body class="snap-y">
    @livewireScripts
    @yield('body')
    @stack('script-end-of-body')
</body>

</html>
