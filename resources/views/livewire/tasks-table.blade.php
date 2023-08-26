<div class="relative shadow-md box-border border-4 border-teal-800">
    <div wire:loading class="bg-blue-400 bg-opacity-30 animate-pulse absolute w-full h-full z-0 "></div>
    <div class="relative z-50">

        <p class="text-[10px] text-white">
            {{-- <span>$targetTaskIdEdit = {{isset($targetTaskIdEdit) ? $targetTaskIdEdit : 'Not Set' }}</span><br> --}}
            {{-- <span>$allTasks = {{isset($allTasks) ? $allTasks: 'Not Set' }}</span> --}}
        </p>

        {{-- Loading State Animations --}}
        <div class="w-full flex flex-col border-t-4 border-b-0 border-teal-800" wire:loading.class="p-1">
        <div class="mb-1 flex w-full justify-center items-center" wire:loading wire:target="edit">
        <div class="w-full flex justify-center items-center animate-pulse border-l-8 border-blue-700 bg-blue-400 bg-opacity-30 p-2 pt-4 text-blue-400">
        <div class="inline-block h-8 w-8 animate-bounce rounded-full border border-blue-600 text-center leading-7">▲</div>
        </div>
        </div>
        <div class="mb-1 flex w-full justify-center items-center" wire:loading wire:target="confirmDelete">
        <div class="w-full flex justify-center items-center animate-pulse border-l-8 border-blue-700 bg-blue-400 bg-opacity-30 p-2 text-blue-400">
        Checking The Task ...
        </div>
        </div>
        <div class="mb-1 flex w-full justify-center items-center" wire:loading wire:target="deleteTask">
        <div class="w-full flex justify-center items-center animate-pulse border-l-8 border-blue-700 bg-blue-400 bg-opacity-30 p-2 text-blue-400">
        Deleting ...
        </div>
        </div>
        <div class="flex w-full justify-center items-center" wire:loading>
        <div class="w-full flex justify-center items-center animate-pulse border-l-8 border-blue-700 bg-blue-400 bg-opacity-30 p-2 text-blue-400">
        Re-Rendering ...
        </div>
        </div>
        </div>

        {{-- They need to be together: `w-screen` & `overflow-x-auto` --}}
        <div class="overflow-x-auto relative w-full inline-block">
            {{-- Table of Tasks --}}
            <table class="text-[14px]">
                <thead class="uppercase bg-gray-50 dark:bg-gray-700 text-white">
                    <tr class="">
                        {{-- <th scope="col" class="px-1 py-0"> --}}
                            {{-- Edit --}}
                        {{-- </th> --}}
                        {{-- <th s cope="col" class="px-1 py-0"> --}}
                        {{-- id --}}
                        {{-- </th> --}}
                        {{-- <th scope="col" class="px-1 py-0"> --}}
                        {{-- user_id --}}
                        {{-- </th> --}}
                        {{-- <th scope="col" class="px-1 py-0"> --}}
                        {{-- C.id --}}
                        {{-- </th> --}}
                        <th scope="col" class="px-1 py-0">
                            Delete
                        </th>
                        {{-- <th scope="col" class="px-1 py-0"> --}}
                        {{-- done --}}
                        {{-- </th> --}}
                        <th scope="col" class="px-1 py-0">
                            starting_date
                        </th>
                        <th scope="col" class="px-1 py-0">
                            ending_date
                        </th>
                        <th scope="col" class="px-1 py-0">
                            Category
                        </th>
                        <th scope="col" class="px-1 py-0">
                            Description
                        </th>
                        <th scope="col" class="px-1 py-0">
                            color
                        </th>
                        <th scope="col" class="px-1 py-0">
                            duration
                        </th>
                        {{-- <th scope="col" class="px-1 py-0"> --}}
                        {{-- starting_time --}}
                        {{-- </th> --}}
                        {{-- <th scope="col" class="px-1 py-0"> --}}
                        {{-- ending_time --}}
                        {{-- </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @isset($allTasks)
                        @forelse ($allTasks as $task)
                            <tr @if ($task->id == $targetTaskIdEdit) @class(['box-border','border','border-indigo-500','bg-gray-900','text-indigo-500','bg-indigo-900','bg-opacity-20']) @endif
                                class="box-border border-b bg-gray-900 border-gray-700 border text-teal-600">
                                {{-- <td class="px-4 py-0"> --}}
                                    {{-- <form wire:submit.prevent="edit({{ $task->id }})"> --}}
                                        {{-- <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button> --}}
                                    {{-- </form> --}}
                                {{-- </td> --}}
                                {{-- <td scope="row" class="box-border hover:box-content px-2 py-1 font-medium whitespace-nowrap text-white"> --}}
                                {{-- {{ $task->id }} --}}
                                {{-- </td> --}}
                                {{-- <td class="px-2 py-0"> --}}
                                {{-- {{ $task->user_id }} --}}
                                {{-- </td> --}}
                                {{-- <td class="px-2 py-0"> --}}
                                {{-- {{ $task->category_id }} --}}
                                {{-- </td> --}}
                                <td class="px-4 py-0">
                                    @if ($confirming === $task->id)
                                        <button wire:click="deleteTask({{ $task->id }})" type="submit" class="font-medium text-blue-600 dark:text-teal-500 hover:underline">Sure?</button>
                                    @else
                                        <button wire:click="confirmDelete({{ $task->id }})" type="submit" class="font-medium text-blue-600 dark:text-gray-500 hover:underline">Delete</button>
                                    @endif
                                </td>
                                {{-- <td class="px-2 py-0"> --}}
                                {{-- {{ $task->done }} --}}
                                {{-- </td> --}}
                                <td class="px-2 py-0 whitespace-nowrap">
                                    {{ date('Y-M(m)-d H:i', $task->starting_time + 12600) }}
                                </td>
                                <td class="px-2 py-0 whitespace-nowrap">
                                    {{ date('Y-M(m)-d H:i', $task->ending_time + 12600) }}
                                </td>
                                <td class="px-2 py-4">
                                    {{ $task->category }}
                                </td>
                                <td class="px-2 py-0">
                                    {{ $task->description }}
                                </td>
                                <td class="px-2 py-0 whitespace-nowrap">
                                    {{-- {{ $task->color }} --}}
                                    <div style="background-color:{{ $task->color }}" class="w-full h-4"></div>
                                </td>
                                <td class="px-2 py-0">
                                    {{ $task->desired_duration }}
                                </td>
                                {{-- <td class="px-2 py-0"> --}}
                                {{-- {{ $task->starting_time }} --}}
                                {{-- </td> --}}
                                {{-- <td class="px-2 py-0"> --}}
                                {{-- {{ $task->ending_time }} --}}
                                {{-- </td> --}}

                            </tr>
                        @empty
                        <div class="bg-gray-500 bg-opacity-20 border-l-8 border-gray-600 text-gray-500 p-2">
                            There are no tasks recorded yet ¯\_(ツ)_/¯
                        </div>
                        @endforelse
                    @endisset

                </tbody>
            </table>
        </div>
        @isset($allTasks)
        {{ $allTasks->links('livewire.pagination-livewire-simple') }}
        @endisset
    </div>
</div>
