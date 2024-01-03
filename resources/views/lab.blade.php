@extends('base')
@section('body')
    {{ url()->current() . "\n" }}<br>
    {{ request()->getPathInfo() }}<br>

    <div class="border border-yellow-500">
        <x-customcalendar />
    </div>

    <div class="border border-red-500 w-10 h-10">

    </div>

    <div id="container" class="flex flex-wrap gap-4 p-4"></div>

    <x-website-logo/>

    <div class="font-tokhmi">This text uses the custom font.</div>
    <div class="" style="font-family:k2;">This text uses the custom font.</div>

@endsection

@push('style')
    <style>
        #container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .cube {
            width: 30px;
            height: 30px;
            background-color: #3498db;
        }


    </style>
@endpush

@push('script-end-of-body')
    <script>
          $(document).ready(function() {
            // Function to create a cube with a number and append it to the container
            function createCube(number) {
                const cube = $('<div class="cube bg-blue-500 flex items-center justify-center cursor-pointer hover:border-2 hover:border-black"></div>');
                cube.text(number);
                return cube;
            }

            // Function to generate and append numbered cubes to the container
            function generateCubes(container, numCubes) {
                for (let i = 1; i <= numCubes; i++) {
                    const cube = createCube(i);
                    container.append(cube);
                }
            }

            // Get the container element using jQuery
            const container = $('#container');

            // Generate 30 numbered cubes inside the container
            generateCubes(container, 30);
        });
    </script>
@endpush
