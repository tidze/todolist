<div>
    {{-- they need to be together `w-screen` `overflow-x-auto` --}}
    <div class="overflow-x-auto relative w-full  inline-block shadow-md sm:rounded-lg box-border border-2 border-teal-800">
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
                            <div style="background-color:{{$task->color}}" class="w-full h-4"></div>
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
                            <form wire:submit.prevent="deleteTask({{ $task->id }})">
                                <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $allTasks->links() }}
</div>
