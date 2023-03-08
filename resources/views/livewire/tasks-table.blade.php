<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-1">
                        id
                    </th>
                    <th scope="col" class="px-3 py-1">
                        category_id
                    </th>
                    <th scope="col" class="px-3 py-1">
                        Categories.category
                    </th>
                    <th scope="col" class="px-3 py-1">
                        Categories.description
                    </th>
                    <th scope="col" class="px-3 py-1">
                        duration
                    </th>
                    <th scope="col" class="px-3 py-1">
                        starting_time
                    </th>
                    <th scope="col" class="px-3 py-1">
                        ending_time
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($allTasks as $task)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $task->id }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $task->category_id }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $task->category }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $task->description }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $task->desired_duration }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $task->starting_time }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $task->ending_time }}
                        </td>
                        <td class="px-4 py-2">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

</div>
