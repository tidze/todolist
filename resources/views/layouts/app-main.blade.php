<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield("title","TodolistMyAss")</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('style')

</head>

<body class="antialiased font-Rubik">
    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

    @livewireScripts
    @stack('script')
    <script></script>
</body>

</html>
