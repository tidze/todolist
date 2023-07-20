<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">

    <title>{{ env('APP_NAME') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
    @livewireStyles
    @stack('script-head')
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-clock-timepicker.min.js') }}"></script>
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

        /* .diagonal-stripes {
            background: repeating-linear-gradient(-45deg, #facc15, #facc15 2px, #ffffff00 0, #ffffff00 11px);
        }

        .diagonal-stripes-x {
            background: repeating-linear-gradient(-45deg, #e879f97a, #e879f97a 2px, #ffffff00 0, #ffffff00 9px);
        } */
        /* input[type=date]{ */
        /* background-color:black; */
        /* } */
    </style>
</head>

<body class="font-sans antialiased">
    @livewireScripts
    <div class="min-h-screen bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        {{-- @if (isset($header)) --}}
        {{-- <header class="bg-white dark:bg-gray-800 shadow"> --}}
        {{-- <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8"> --}}
        {{-- {{ $header }} --}}
        {{-- </div> --}}
        {{-- </header> --}}
        {{-- @endif --}}
        <div class="bg-gray-800 text-white max-w-6xl mx-auto lg:px-0 mb-1">
            <div class="text-yellow-400 border-yellow-700 border-l-8 p-2 bg-yellow-400 bg-opacity-30">Welcome <span class="text-white">{{ Auth::user()->name }}</span> !</div>
        </div>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>


        @stack('script')
        <script></script>
    </div>
</body>

</html>
