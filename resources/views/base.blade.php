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
    <link rel="icon" type="image/x-icon" href="{{ asset('website-assets/planpacer_2_logo.png') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
    @stack('script-head')
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .debug-border {
            border: 1px solid tomato;
        }

        .debug-border * {
            border: 1px solid tomato;
        }

        @font-face {
            font-family: 'kiri2';
            /* src: url('/fonts/digital_7/Digital Display.ttf') format('ttf'); */
            src: url('../../public/fonts/digital_display/DigitalDisplay.ttf') format('ttf');
            /* src: url('/fonts/digital_display/DigitalDisplay.ttf') format('ttf'); */
            /* font-weight: normal; */
            /* font-style: normal; */
        }

        @font-face{
            font-family: k2;
            src: url('public/fonts/digital-7.ttf');
        }

        body {
            font-family: 'YourFont', sans-serif;
        }
    </style>
</head>

<body class="snap-y">
    <div style="font-family: k2">kiri font 2</div>
    <div class="font-rdodle">This text uses the custom font.22222222222222</div>


    @yield('body')
    @stack('script-end-of-body')
</body>

</html>
