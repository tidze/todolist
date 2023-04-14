<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">

    <title>{{ config('app.name', 'Laravel') }}</title>
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

        /* .diagonal-stripes {
            background: repeating-linear-gradient(-45deg, #facc15, #facc15 2px, #ffffff00 0, #ffffff00 11px);
        }

        .diagonal-stripes-x {
            background: repeating-linear-gradient(-45deg, #e879f97a, #e879f97a 2px, #ffffff00 0, #ffffff00 9px);
        } */
        input[type=date]{
            background-color:black;
        }
    </style>
</head>

<body class="font-sans antialiased">
    @livewireScripts
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <div class="sm:w-[500px] sm:ml-auto sm:mr-auto sm:block py-4">

            {{-- {{ public_path() }}<br> --}}
            {{-- {{ base_path() }}<br> --}}
            {{-- {{ storage_path() }}<br> --}}
            {{-- {{ app_path() }}<br> --}}

            @livewire('task')

            @livewire('tasks-table')

            @livewire('category-color')

            @livewire('custom-chart')

            @livewire('custom-graph-x')

            {{-- @yield('content') --}}

            @include('layouts.footer')

        </div>
        @stack('script')
        <script></script>

    </div>
</body>

</html>
