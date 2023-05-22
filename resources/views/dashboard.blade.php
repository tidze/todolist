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


    <div class="max-w-xl lg:max-w-6xl lg:flex-row mx-auto flex flex-wrap flex-col">
        <div class="w-full lg:w-1/2">
            @livewire('task')

        </div>
        <div class="w-full lg:w-1/2">
            @livewire('custom-chart')

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
            {{-- @livewire('category-color') --}}
        {{-- </div> --}}

        <div>
        </div>

    </div>
    @include('layouts.footer')
</x-app-layout>
