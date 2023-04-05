<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Todolist app')</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2991/2991148.png">
    {{-- <link rel="stylesheet" href="{{asset('build/assets/app-6004121e.css')}}"> --}}
    {{-- <script src="{{asset('build/assets/app-2f7bb1b3.js')}}"></script> --}}
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
    </style>
</head>

<body class="antialiased font-Rubik">
    @livewireScripts
    {{-- {{ public_path() }}<br> --}}
    {{-- {{ base_path() }}<br> --}}
    {{-- {{ storage_path() }}<br> --}}
    {{-- {{ app_path() }}<br> --}}

    @livewire('task')

    @livewire('tasks-table')

    @livewire('custom-chart')

    {{-- @livewire('custom-graph-x') --}}

    {{-- @yield('content') --}}

    {{-- all tasks from database into table format --}}

    @include('layouts.footer')
    @stack('script')
    <script></script>
</body>

</html>
