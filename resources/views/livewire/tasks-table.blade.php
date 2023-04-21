<div>
    <div class="w-full flex">
        <div class="m-1 flex w-full justify-center items-center" wire:loading wire:target="edit">
            <div class="w-full flex justify-center items-center animate-pulse border-l-8 border-blue-700 bg-blue-400 bg-opacity-30 p-2 pt-4 text-blue-400">
                <div class="inline-block h-8 w-8 animate-bounce rounded-full border border-blue-600 text-center leading-7">▲</div>
            </div>
        </div>
        <div class="m-1 flex w-full justify-center items-center" wire:loading wire:target="confirmDelete">
            <div class="w-full flex justify-center items-center animate-pulse border-l-8 border-blue-700 bg-blue-400 bg-opacity-30 p-2 text-blue-400">
                Checking The Task ...
            </div>
        </div>
        <div class="m-1 flex w-full justify-center items-center" wire:loading wire:target="deleteTask">
            <div class="w-full flex justify-center items-center animate-pulse border-l-8 border-blue-700 bg-blue-400 bg-opacity-30 p-2 text-blue-400">
                Deleting ...
            </div>
        </div>
    </div>
    {{-- they need to be together `w-screen` `overflow-x-auto` --}}
    <div class="overflow-x-auto relative w-full inline-block shadow-md box-border border-4 border-teal-800">
        <table class="text-[14px]">
            <thead class="uppercase bg-gray-50 dark:bg-gray-700 text-white">
                <tr class="">
                    <th scope="col" class="px-1 py-0">
                        Edit
                    </th>
                    {{-- <th scope="col" class="px-1 py-0"> --}}
                    {{-- id --}}
                    {{-- </th> --}}
                    {{-- <th scope="col" class="px-1 py-0"> --}}
                    {{-- user_id --}}
                    {{-- </th> --}}
                    {{-- <th scope="col" class="px-1 py-0"> --}}
                    {{-- C.id --}}
                    {{-- </th> --}}
                    <th scope="col" class="px-1 py-0">
                        starting_date
                    </th>
                    <th scope="col" class="px-1 py-0">
                        ending_date
                    </th>
                    <th scope="col" class="px-1 py-0">
                        C.category
                    </th>
                    <th scope="col" class="px-1 py-0">
                        C.description
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
                    <th scope="col" class="px-1 py-0">
                        Delete
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allTasks as $task)
                    <tr @if ($task->id == $sendBackId) @class(['box-border','border','border-indigo-500','bg-gray-900','text-indigo-500']) @endif
                        class="box-border border-b bg-gray-900 border-gray-700 border text-teal-600">
                        <td class="px-4 py-0">
                            <form wire:submit.prevent="edit({{ $task->id }})">
                                <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                            </form>
                        </td>
                        {{-- <td scope="row" class="box-border hover:box-content px-2 py-1 font-medium whitespace-nowrap text-white"> --}}
                        {{-- {{ $task->id }} --}}
                        {{-- </td> --}}
                        {{-- <td class="px-2 py-0"> --}}
                        {{-- {{ $task->user_id }} --}}
                        {{-- </td> --}}
                        {{-- <td class="px-2 py-0"> --}}
                        {{-- {{ $task->category_id }} --}}
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
                        <td class="px-4 py-0">
                            @if ($confirming === $task->id)
                                <button wire:click="deleteTask({{ $task->id }})" type="submit" class="font-medium text-blue-600 dark:text-teal-500 hover:underline">Sure?</button>
                            @else
                                <button wire:click="confirmDelete({{ $task->id }})" type="submit" class="font-medium text-blue-600 dark:text-gray-500 hover:underline">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $allTasks->links('livewire.pagination-livewire-simple') }}
</div>
