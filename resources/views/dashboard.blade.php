<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>


    <div class="sm:w-[500px] sm:ml-auto sm:mr-auto sm:block pb-4">

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
</x-app-layout>
