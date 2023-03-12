<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todolist</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('jquery')
    @stack('clock-timepicker')

</head>

<body class="antialiased font-Rubik">
    @include('layouts.navbar')
    @yield('content')
    @livewireScripts
    @stack('script')

    @livewire('task')

    <br>
    {{-- all tasks from database into table format --}}
    @livewire('tasks-table')

    @include('layouts.footer')
    <script>

    </script>
</body>

</html>
