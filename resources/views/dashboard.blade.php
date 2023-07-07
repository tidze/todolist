<x-app-layout>
    <x-slot name="header">

    </x-slot>

    {{-- <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="max-w-xl lg:max-w-6xl lg:flex-row mx-auto flex flex-wrap flex-col"> --}}
    {{-- @livewire('timepoint-selector') --}}
    {{-- </div> --}}


    <div class="max-w-xl flex-1 mx-auto flex flex-wrap flex-col lg:max-w-6xl lg:flex-row ">

        <div class="w-full flex flex-col lg:flex-row">
            <div class="w-full flex flex-col lg:flex-1 lg:w-1/2" id="task-container">
                @livewire('task')
                <div id="hashure-div" class="hidden lg:block border-4 border-gray-200 flex-auto" style="background: repeating-linear-gradient(-45deg, #ffffffaa, #ffffffaa 4px, #ffffffdd 0, #ffffff00 11px)"></div>
            </div>
            <div class="flex lg:flex-1" id="custom-chart-container">
                @livewire('custom-chart')
            </div>
        </div>

        <div class="w-full lg:w-full">
            @livewire('custom-graph-x')
        </div>

    </div>


    <div class="max-w-xl lg:max-w-6xl lg:flex-row mx-auto flex flex-wrap flex-col">
        {{-- {{ public_path() }}<br> --}}
        {{-- {{ base_path() }}<br> --}}
        {{-- {{ storage_path() }}<br> --}}
        {{-- {{ app_path() }}<br> --}}
        {{-- <div class="w-full"> --}}
        {{-- @livewire('tasks-table') --}}
        {{-- </div> --}}

        {{-- <div class="w-full"> --}}
        {{-- </div> --}}

        <div>
        </div>

    </div>
    @include('layouts.footer')
</x-app-layout>

{{-- @push('script-head') --}}
<script>
    // $(document).ready(function() {
    // Check if window width is larger than 1024 pixels
    // if ($(window).width() >= 1009) {
    // let height = $('#custom-chart-container').height() - $('#task-container').height();
    // $('#hashure-div').height(height);
    // } else {}
    // });

    // $(window).on('resize', function() {
    // var windowWidth = $('#task-container').width();
    // var windowHeight = $('#task-container').height();
    // if ($(window).width() >= 1009) {
    // let height = $('#custom-chart-container').height() - $('#task-container').height();
    // $('#hashure-div').height(height);
    // } else {
    // }
    // console.log('Resolution changed. Width: ' + windowWidth + ', Height: ' + windowHeight);
    // });
</script>
{{-- @endpush --}}
