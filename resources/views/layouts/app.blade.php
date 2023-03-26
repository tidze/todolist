<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Todolist app')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
    @livewireStyles

    @stack('script-head')
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-clock-timepicker.min.js') }}"></script>
    <style>
        .debug-border{
            border:1px solid tomato;
        }
        .debug-border *{
            border:1px solid tomato;
        }
        </style>
</head>

<body class="antialiased font-Rubik">
    @livewireScripts
    {{-- app.blade.php --}}
    {{-- <br> --}}
    {{-- @include('layouts.navbar') --}}

    @livewire('custom-chart')

    {{-- @yield('content') --}}

    @livewire('task')

    {{-- all tasks from database into table format --}}
    @livewire('tasks-table')

    @include('layouts.footer')
    @stack('script')
    <script></script>
</body>

</html>
