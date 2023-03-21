<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-[9px] text-left ">
            <thead class="uppercase bg-gray-50 dark:bg-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-1 py-0">
                        id
                    </th>
                    <th scope="col" class="px-1 py-0">
                        c_id
                    </th>
                    <th scope="col" class="px-1 py-0">
                        C.category
                    </th>
                    <th scope="col" class="px-1 py-0">
                        C.description
                    </th>
                    <th scope="col" class="px-1 py-0">
                        duration
                    </th>
                    <th scope="col" class="px-1 py-0">
                        starting_time
                    </th>
                    <th scope="col" class="px-1 py-0">
                        ending_time
                    </th>
                    <th scope="col" class="px-1 py-0">
                        starting_date
                    </th>
                    <th scope="col" class="px-1 py-0">
                        ending_date
                    </th>
                    <th scope="col" class="px-1 py-0">
                        Edit
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($allTasks as $task)
                    <tr @if ($task->id == $sendBackId) @class(['box-border','border','border-indigo-500','bg-gray-900','text-indigo-500']) @endif
                        class="box-border border-b bg-gray-900 border-gray-700 border text-teal-600">
                        <td scope="row" class="box-border hover:box-content px-2 py-1 font-medium whitespace-nowrap text-white">
                            {{ $task->id }}
                        </td>
                        <td class="px-2 py-0">
                            {{ $task->category_id }}
                        </td>
                        <td class="px-2 py-0">
                            {{ $task->category }}
                        </td>
                        <td class="px-2 py-0">
                            {{ $task->description }}
                        </td>
                        <td class="px-2 py-0">
                            {{ $task->desired_duration }}
                        </td>
                        <td class="px-2 py-0">
                            {{ $task->starting_time }}
                        </td>
                        <td class="px-2 py-0">
                            {{ $task->ending_time }}
                        </td>
                        <td class="px-2 py-0">
                            {{ date('Y-M(m)-d H:i', $task->starting_time + 12600) }}
                        </td>
                        <td class="px-2 py-0">
                            {{ date('Y-M(m)-d H:i', $task->ending_time + 12600) }}
                        </td>
                        <td class="px-2 py-0">
                            <form wire:submit.prevent="edit({{ $task->id }})">
                                <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                            </form>
                            <form wire:submit.prevent="deleteTask({{ $task->id }})">
                                <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

</div>
