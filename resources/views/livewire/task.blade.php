<div>
    <input type="date" id="targetDate">
    <label for="targetDate">targetDate</label>
    <form method="POST" wire:submit.prevent="store">
        @csrf
        <div>
            <input id="startingDate" type="date" class="">
            <input id="startingTimepoint" class="time startingTimepoint bg-black text-white text-center w-40" type="text" value="10:15" />
            <label for="startingTimepoint">startingTimepoint</label>
            <input name="startingTimepoint_obj" id="startingTimepoint_obj" class="bg-black text-white text-center w-40 p-0 text-[10px]" type="text" value="0" />
        </div>

        <div>
            <input id="endingDate" type="date" class="">
            <input id="endingTimepoint" class="time endingTimepoint bg-black text-white text-center w-40" type="text" value="10:15" onchange="" />
            <label for="endingTimepoint">endingTimepoint</label>
            <input name="endingTimepoint_obj" id="endingTimepoint_obj" class="bg-black text-white text-center w-40 p-0 text-[10px]" type="text" value="0" />
        </div>
        <div>
            <input id="fullDuration_obj" class="bg-black text-white text-center w-64 p-0 text-[10px]" type="text" value="sdf" />
            <label for="fullDuration">fullDuration</label>
        </div>
        <div class="w-52 py-5 relative">
            <div class="absolute flex left-full mx-2">
                <label id="rangeValue" class="">d0</label>
                <span class="mx-1">m</span>
            </div>
            <input name="desiredDuration" id="desiredDuration" min="0" max="10" type="range" value="0"
                class="w-full h-2 bg-gray-700 p-1 rounded-lg appearance-none cursor-pointer range-lg" oninput="rangeValue.innerText = this.value">
        </div>

        <div>
            <input id="taskCategory" wire:model="taskCategory" name="taskCategory" type="text" class="bg-black text-white text-center w-64 p-0 text-[10px]">
            <label for="taskCategory">taskCategory</label>
            @error('taskCategory')<span class="bg-black">{{ $message }}</span>@enderror
            <br>
            <input id="taskDescription" wire:model="taskDescription" name="taskDescription" type="text" class="bg-black text-white text-center w-64 p-0 text-[10px]">
            <label for="taskDescription">taskDescription</label>
            @error('taskDescription')<span class="text-red-500">{{ $message }}</span>@enderror
        </div>
        <button type="submit"
            class="px-3 py-1 text-xs font-medium mr-2 mb-2 text-gray-900
        focus:outline-none bg-white rounded-lg border border-gray-200
        hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
        focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
        dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
        dark:hover:bg-gray-700">Add Task</button>
    </form>
</div>
