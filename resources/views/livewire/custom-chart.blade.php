<div class="relative border-4 border-yellow-700 box-border text-white text-[10px]">
    <div wire:loading class="bg-blue-400 bg-opacity-30 animate-pulse absolute w-full h-full"></div>
    {{-- Components Debugger Information --}}
    <div class="text-yellow-500 text-[11px] w-full">
        {{-- date_default_timezone_get=<span class="text-amber-100">{{ date_default_timezone_get() }}</span><br> --}}
        {{-- $c_startingDatepoint_unix = <span class="text-yellow-100">{{ isset($c_startingDatepoint_unix) ? substr($c_startingDatepoint_unix,0,10)+12600 . ' ' . date('Y-m-d H:i', substr($c_startingDatepoint_unix,0,10)+12600) : 'Not Set' }}</span> <br> --}}
        {{-- $c_endingDatepoint_unix = <span class="text-yellow-100">{{ isset($c_endingDatepoint_unix) ? substr($c_endingDatepoint_unix,0,10)+12600 . ' ' . date('Y-m-d H:i', substr($c_endingDatepoint_unix,0,10)+12600) : 'Not Set' }}</span><br> --}}
        {{-- $c_startingDate = <span class="text-yellow-100">{{ isset($c_startingDate) ? $c_startingDate : 'Not Set' }}</span><br> --}}
        {{-- $c_endingDate = <span class="text-yellow-100">{{ isset($c_endingDate) ? $c_endingDate : 'Not Set' }}</span><br> --}}
        {{-- $c_startingHourpoint = <span class="text-yellow-100">{{ isset($c_startingHourpoint) ? $c_startingHourpoint : 'Not Set' }}</span><br> --}}
        {{-- $c_endingHourpoint = <span class="text-yellow-100">{{ isset($c_endingHourpoint) ? $c_endingHourpoint : 'Not Set' }}</span><br> --}}
        {{-- $c_targetTaskIdForEdit = <span class="text-yellow-100">{{ isset($c_targetTaskIdForEdit) ? $c_targetTaskIdForEdit : 'Not Set' }}</span><br> --}}
        {{-- $now = <span class="text-yellow-100">{{ var_dump($now) }}</span><br> --}}
        {{-- $dailyTasks --> =<pre class="text-yellow-100">{{ isset($dailyTasks) ? print_r($dailyTasks) : 'Not Set' }}</pre><br> --}}
        {{-- $taskSumOfDurations = <span class="text-yellow-100">{{ print_r($taskSumOfDurations) }}</span><br> --}}
        {{-- $c_flattened --> =<span class="text-yellow-100">{{ isset($c_flattened) ? print_r($c_flattened) : 'Not Set' }}</span><br> --}}
        {{-- $flattened = <span class="text-yellow-100">{{ var_dump($flattened) }}</span><br> --}}
        {{-- timezone= <span class="text-yellow-100">{{ $timezone ?? 'Not Set' }}</span><br> --}}
        {{-- $is_date_different = <span class="text-yellow-100">{{ isset($is_date_different) ? $is_date_different : 'Not Set' }}</span><br> --}}
    </div>
    <div class="relative z-20 flex flex-col text-base">
        {{-- <span id="c_customDebug" class="inline-block border border-amber-600 p-0.5 rounded hover:bg-yellow-500 hover:text-black cursor-pointer" wire:click>c_customDebug</span> --}}
        {{-- <br> --}}
        <div class="flex justify-center items-center">
            <div class="border-2 flex items-center justify-center rounded-xl border-gray-500 mx-2 p-2 active:border-blue-500 active:border-2 cursor-default select-none" wire:click="prevPeriod">◄ ↺</div>
            <div id="c_targetDate_Container" class="flex items-center justify-center p-2">
                <input class="inline-block border-2 rounded-xl border-gray-500 bg-gray-800" id="c_targetDate" type="date" value="">
                <label class="px-1" for="c_targetDate">Date</label>
            </div>
            <div class="border-2 flex items-center justify-center rounded-xl border-gray-500 mx-2 p-2 active:border-blue-500 active:border-2 cursor-default select-none" wire:click="nextPeriod">► ↻</div>
        </div>

        {{-- Component c_startingTimepoint --}}
        <div class="flex">
            {{-- for input date overlay to be clickable every where --}}
            <div id="c_startingDateContainer" class="basis-2/5 inline-block border rounded-xl border-transparent">
                <input id="c_startingDate" class="border-2 rounded-xl border-gray-500 bg-gray-800" wire:model.defer="c_startingDate" {{-- wire:ignore --}} type="date" value="">
            </div>
            <div class="basis-2/5 flex">
                <input class="inline-block w-40 bg-black text-center border-2 h-full rounded-xl border-gray-500" id="c_startingHourpoint" wire:model.defer="c_startingHourpoint" type="text">
            </div>
            <label class="basis-1/5 self-center" for="c_startingHourpoint">Start</label>
            <input id="c_startingDatepoint_unix" name="c_startingDatepoint_unix" class="bg-black text-center text-[8px]" wire:model.defer="c_startingDatepoint_unix" type="hidden" value="">
            {{-- <label for="c_startingDatepoint_unix">c_startingDatepoint_unix</label> --}}
            {{-- @error('c_startingDatepoint_unix') --}}
            {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
            {{-- @enderror --}}
        </div>

        {{-- Component c_endingTimepoint --}}
        <div class="flex">
            {{-- for input date overlay to be clickable every where --}}
            <div id="c_endingDateContainer" class="basis-2/5 inline-block border rounded-xl border-transparent">
                <input id="c_endingDate" class="border-2 rounded-xl border-gray-500 bg-gray-800" wire:model.defer="c_endingDate" type="date" value="">
            </div>
            <div class="basis-2/5 flex">
                <input id="c_endingHourpoint" class="w-40 bg-black text-center border-2 h-full rounded-xl border-gray-500" wire:model.defer="c_endingHourpoint" type="text">
            </div>
            <label class="basis-1/5 self-center" for="c_endingHourpoint">End</label>
            <input id="c_endingDatepoint_unix" name="c_endingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]" wire:model.defer="c_endingDatepoint_unix" type="hidden" value="">
            {{-- <label for="c_endingDatepoint_unix">c_endingDatepoint_unix</label> --}}
            {{-- @error('c_endingDatepoint_unix') --}}
            {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
            {{-- @enderror --}}
        </div>

        <div class="flex flex-row">
            <button
                class="flex-1 px-3 py-2 m-1 text-center text-sm font-medium text-gray-900
            focus:outline-none bg-white border border-gray-200 rounded-xl
          hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
          focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
          dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
          dark:hover:bg-gray-700"
                wire:click="getTask">
                Daily Report</button>
            {{-- <button id="c_flattenTasksGraph"
                class="flex-1 px-3 py-3 m-1 text-center text-sm font-medium text-gray-500
                bg-white border border-gray-200 rounded-xl
                dark:text-gray-400 dark:border-gray-600"
                wire:click="flattenTasksGraph">
                Flat
            </button> --}}
            {{-- <button id=""
                class="flex-1 px-3 py-3 m-1 text-center text-sm font-medium text-gray-500
                bg-white border border-gray-200 rounded-xl

              dark:text-gray-400 dark:border-gray-600" wire:click=""
                disabled>
                getTimeAndDate
            </button> --}}
        </div>

        {{-- Loading Animation For When Http Request is happening. --}}
        {{-- <div class="p-1" wire:loading> --}}
        {{-- <div class="text-blue-400 border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Re-Rendering ...</div> --}}
        {{-- </div> --}}
        {{-- <div class="p-1" wire:loading wire:target="getTask"> --}}
        {{-- <div class="text-blue-400 border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Loading Custom Graph ...</div> --}}
        {{-- </div> --}}
        {{-- <div class="p-1" wire:loading wire:target="flattenTasksGraph"> --}}
        {{-- <div class="text-blue-400 border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Flattening Tasks ...</div> --}}
        {{-- </div> --}}
        {{-- <div class="p-1" wire:loading wire:target="prevPeriod"> --}}
        {{-- <div class="text-blue-400 border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Going Previous Period ...</div> --}}
        {{-- </div> --}}
        {{-- <div class="p-1" wire:loading wire:target="nextPeriod"> --}}
        {{-- <div class="text-blue-400 border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Going Next Period ...</div> --}}
        {{-- </div> --}}
    </div>
    {{-- Dayily Graph Chart --}}
    <div class="flex flex-col">
        <div class="flex justify-end">
            <div class="flex justify-end relative pt-11 pb-2 px-9 border-2 border-red-400 border-opacity-0 w-full">
                <div class="border-2 border-orange-800 border-opacity-50 w-[65%] h-[78vh] relative right-0 box-border">
                    {{-- startTimepointHandle --}}
                    <div class="w-[10%] h-[2px] bg-amber-700 border-t-2 border-t-amber-700 absolute right-full bottom-full">
                        <div class="relative flex flex-row justify-center items-center w-[45px] -translate-x-2/4 -translate-y-2/4 -rotate-90 h-10">
                            <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-start invisible">
                            </div>
                            <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-end ml-[2px]">
                                <div class="w-[1px] h-5 translate-x-full rotate-90 flex justify-end items-center">
                                    <div class="text-amber-200 text-[14px] inline-block pl-1 translate-x-full -translate-y-1/3 whitespace-nowrap">
                                        {{ date('Y-m-d H:i', substr($c_startingDatepoint_unix, 0, 10) + 12600) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- endTimepointHandle --}}
                    <div class="w-[10%] h-px bg-amber-700 border-t-2 border-t-amber-700 absolute top-full left-full">
                        <div class="relative flex flex-row justify-center items-center w-[140px] -translate-x-2/4 -translate-y-2/4 -rotate-90 h-10 -right-full">
                            <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-end invisible"></div>
                            <div class="bg-amber-700 flex-[auto] h-px ml-[3px] flex items-center justify-end">
                                <div class="w-[3px] h-5 translate-x-2/4 translate-y-0 rotate-0 flex justify-start items-center">
                                    <div class="text-amber-200 text-[14px] whitespace-nowrap mx-4">
                                        {{ date('Y-m-d  H:i', substr($c_endingDatepoint_unix, 0, 10) + 12600) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Now Indicator --}}
                    <div class="box-border absolute flex border-t border-t-yellow-400 w-[125%] -translate-x-[20%] " style="{{ $now['top'] }};visibility:{{ $now['visible'] }}">
                        <div class="box-border flex justify-between bg-gray-500 bg-opacity-60 rounded-sm text-[12px]">
                            <div class="px-2">{{ date('H:i', $now['unix'] + 12600) }}</div>
                        </div>

                        <div class="box-border absolute flex flex-row -translate-x-full" style="{{ $now['top'] }};">
                            <div class="box-border -translate-y-[65%] mx-1 flex flex-col justify-center items-center">
                                <div class="text-white-500 text-[14px]">
                                    Now
                                </div>
                                {{-- Hour:Minute indicator --}}
                            </div>
                        </div>
                    </div>


                    @isset($dailyTasks)

                        @foreach ($dailyTasks as $_task)
                            @if ($_task['done'])
                                <div class="
                                    flex
                                    taskGraphItem
                                    box-border
                                    {{ $_task['translate'] ?? '' }}
                                    {{ $_task['position'] ?? '' }}
                                    w-full
                                    text-[9px]
                                    border-2
                                    border-opacity-70"
                                    style="
                                    {{ $_task['top'] ?? '' }} ;
                                    {{ $_task['height'] ?? '' }};
                                    background: repeating-linear-gradient(-45deg, {{ $_task['color'] }}, {{ $_task['color'] }} 2px, #ffffff00 0, #ffffff00 6px);
                                    border-color: {{ $_task['color'] }}">
                                @else
                                    <div class="flex
                                    taskGraphItem
                                    box-border
                                    {{ $_task['translate'] ?? '' }}
                                    {{ $_task['position'] ?? '' }}
                                    w-full
                                    text-[9px]
                                    border-2
                                    border-opacity-70"
                                        style="
                                    {{ $_task['top'] ?? '' }} ;
                                    {{ $_task['height'] ?? '' }};
                                    border-color: rgb(126, 126, 126)">
                            @endif

                            {{-- Close button next to each task for deleting them. --}}
                            <div class="absolute right-0 translate-x-full border-t border-yellow-500">
                                @if ($confirming === $_task['id'])
                                    <div class="text-xs w-6 h-6 -ml-4 translate-x-full -translate-y-1/2 border border-teal-600 bg-teal-500 bg-opacity-20 text-teal-500
                                rounded-full cursor-pointer inline-flex justify-center items-center hover:bg-opacity-40 hover:font-bold"
                                        wire:click="deleteTask({{ $_task['id'] }})">
                                        &#10003 ?
                                    </div>
                                @else
                                    <div class="text-xs w-6 h-6 -ml-4 translate-x-full -translate-y-1/2 border border-yellow-600 bg-yellow-500 bg-opacity-20 text-yellow-500
                                rounded-full cursor-pointer inline-flex justify-center items-center hover:bg-opacity-40 hover:font-bold"
                                        wire:click="confirmDelete({{ $_task['id'] }})">
                                        &#10005
                                    </div>
                                @endif
                            </div>
                            {{-- The Starting point is 100% off by Y Axis so i added translate transform --}}
                            {{-- I don't know why, but the @class needs to be before the class="". (because the `if statement` not going to work otherwise) --}}
                            <div @if ($c_targetTaskIdForEdit_ == $_task['id']) @class(['bg-white','bg-opacity-50' ,'w-full', 'h-full','cursor-pointer']) @endif class="w-full h-full cursor-pointer"
                                wire:click="edit({{ $_task['id'] }})"></div>

                            <div class="absolute flex flex-row -translate-x-full">
                                <div class=" -translate-y-[30%] mx-1 flex flex-col justify-center items-center">
                                    <div @if ($c_targetTaskIdForEdit_ == $_task['id']) @class(['text-teal-500','text-[14px]']) @endif class="text-white-500 text-[14px]">
                                        {{ $_task['description'] }}
                                    </div>
                                    <div @if ($c_targetTaskIdForEdit_ == $_task['id']) @class(['bg-teal-500','bg-opacity-40','text-teal-500','text-[12px]', 'inline-flex' ,'font-medium', 'underline', 'cursor-pointer','relative' ,'z-10']) @endif
                                        class="text-[12px] inline-flex font-medium text-blue-600 dark:text-gray-500 hover:underline cursor-pointer relative z-10" wire:click="edit({{ $_task['id'] }})">Edit</div>
                                </div>

                                {{-- time indicator --}}
                                <div class="box-border border border-b-transparent border-r-transparent border-l-transparent border-t-yellow-400 pr-2">
                                    <div class="flex justify-between bg-gray-500 bg-opacity-60 rounded-sm text-[12px]">
                                        <div class="mx-0.5">{{ date('H:i', $_task['starting_time'] + 12600) }}</div>
                                        {{-- Add Additional Space ▼ --}}
                                        &nbsp
                                        <div class="mr-1">{{ date('H:i', $_task['ending_time'] + 12600) }}</div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    @endforeach
                @endisset

            </div>
        </div>
    </div>

    {{-- TasksCategory Duration --}}
    @isset($taskSumOfDurations)
        @foreach ($taskSumOfDurations as $category => $duration)
            <div class="text-sm">{{ $category }} <span class="text-amber-400">{{ substr($duration / 3600, 0, 4) }}</span> h<span> &nbsp; | &nbsp; </span><span
                    class="text-amber-600">{{ (substr($duration / 3600, 0, 4) / (($c_endingDatepoint_unix - $c_startingDatepoint_unix) / 60 / 60)) * 100 }}</span> % </div>
        @endforeach
        {{-- This if statement needs fix. --}}
        @if ($now['visible'] == 'visible')
            <div class="text-sm">Used <span class="text-amber-400">{{ substr(array_sum($taskSumOfDurations) / 60 / 60,0,4) }}</span> h <span> &nbsp; | &nbsp; </span><span
                    class="text-amber-600">{{ substr((array_sum($taskSumOfDurations) / 60 / 60 / (($c_endingDatepoint_unix - $c_startingDatepoint_unix) / 60 / 60)) * 100,0,4) }}</span> % </div>
            <div class="text-sm">Remained <span class="text-amber-400">{{ substr(($c_endingDatepoint_unix - $now['unix']) / 60 / 60,0,4)  }}</span> h <span> &nbsp; | &nbsp;
                </span><span
                    class="text-amber-600">{{

                                substr((($c_endingDatepoint_unix - $now['unix']) /
                                ($c_endingDatepoint_unix - $c_startingDatepoint_unix)
                                * 100),0,4)

                            }}</span> %
            </div>
            <div class="text-sm">Unknown <span class="text-amber-400">{{
                    substr(
                        ($now['unix']
                        - $c_startingDatepoint_unix
                        - array_sum($taskSumOfDurations))/60/60
                        ,0,4)
                     }}</span> h <span> &nbsp; | &nbsp;
            </span><span class="text-amber-600">
                {{

            substr(
                    (
                        (
                            $now['unix']
                            - $c_startingDatepoint_unix
                            - array_sum($taskSumOfDurations)
                        )
                        /
                        (
                            $c_endingDatepoint_unix
                            -
                            $c_startingDatepoint_unix
                        )
                        *100
                    ),0,4)
                }}</span> %
        </div>
        @endif
    @endisset
    {{-- TasksCategory Description --}}
    @isset($tasksSortedByDescription_Sum)
        @foreach ($tasksSortedByDescription_Sum as $category => $duration_sum)
            <div class="text-sm text-gray-300">{{$category}}<span class="text-orange-400">{{$duration_sum/60}}</span><span> m </span><span class="text-amber-400">{{substr($duration_sum/60/60,0,4)}}</span><span> h </span></div>
        @endforeach
    @endisset
</div>
</div>

@push('script')
    <script>
        // console.log('CustomChart Script Loaded.')
        Livewire.hook('component.initialized', (component) => {
            $('#c_startingHourpoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('#c_endingHourpoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            // setDateForToday("#c_targetDate");
            // copyDate("#c_targetDate", "#c_startingDate");
            // copyDate("#c_targetDate", "#c_endingDate");
        });

        Livewire.hook('element.updated', (el, component) => {
            $('#c_startingHourpoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('#c_endingHourpoint').clockTimePicker({
                autosize: true,
                onModeSwitch: function(MINUTE) {},
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });

        $("#c_targetDate").on("change", () => {
            copyDate("#c_targetDate", "#c_startingDate");
            copyDate("#c_targetDate", "#c_endingDate");
            giveDateObject("#c_startingDate", "#c_startingHourpoint", "#c_startingDatepoint_unix");
            giveDateObject("#c_endingDate", "#c_endingHourpoint", "#c_endingDatepoint_unix");
            document.getElementById("c_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("c_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("c_startingDate").dispatchEvent(new Event('input'));
            document.getElementById("c_endingDate").dispatchEvent(new Event('input'));
        });

        $("#c_startingHourpoint").on("change", () => {
            giveDateObject("#c_startingDate", "#c_startingHourpoint", "#c_startingDatepoint_unix");
            document.getElementById("c_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("c_startingHourpoint").dispatchEvent(new Event('input'));
        });

        $("#c_endingHourpoint").on("change", () => {
            giveDateObject("#c_endingDate", "#c_endingHourpoint", "#c_endingDatepoint_unix");
            document.getElementById("c_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("c_endingHourpoint").dispatchEvent(new Event('input'));
            // console.log('c_endingHourpoint on change');
        });
        $("#c_startingDatepoint_unix").on("change", () => {
            giveDateObject("#c_startingDate", "#c_startingHourpoint", "#c_startingDatepoint_unix");
            document.getElementById("c_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("c_startingHourpoint").dispatchEvent(new Event('input'));
        });
        $("#c_endingDatepoint_unix").on("change", () => {
            giveDateObject("#c_endingDate", "#c_endingHourpoint", "#c_endingDatepoint_unix");
            document.getElementById("c_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("c_endingHourpoint").dispatchEvent(new Event('input'));
            // console.log('c_endingHourpoint on change');
        });
        $('#c_flattenTasksGraph').on('click', function() {
            console.log('c_flattenTasksGraph');
        });

        $('#c_customDebug').on('click', function() {
            console.group("c_customDebug");
            let date = new Date(parseInt($('#c_startingDatepoint_unix').val()));
            let date2 = new Date(parseInt($('#c_endingDatepoint_unix').val()));
            //
            console.log('c_startingDatepoint_unix', date, $('#c_startingDatepoint_unix').val());
            console.log('c_endingDatepoint_unix', date2, $('#c_endingDatepoint_unix').val());
            console.groupEnd();
        });

        $("#c_startingDate").on("change", () => {
            giveDateObject("#c_startingDate", "#c_startingHourpoint", "#c_startingDatepoint_unix");
            document.getElementById("c_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("c_startingHourpoint").dispatchEvent(new Event('input'));

        });

        $("#c_endingDate").on("change", () => {
            giveDateObject("#c_endingDate", "#c_endingHourpoint", "#c_endingDatepoint_unix");
            document.getElementById("c_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("c_endingHourpoint").dispatchEvent(new Event('input'));

        });
        // for all input[date], to be selectable with just clicking anywhere on input. (not just date picker icon)
        $("#c_targetDate_Container").on("click", () => {
            document.querySelector("#c_targetDate").showPicker();
        });
        $("#c_startingDateContainer").on("click", () => {
            document.querySelector("#c_startingDate").showPicker();
        });
        $("#c_endingDateContainer").on("click", () => {
            document.querySelector("#c_endingDate").showPicker();
        });
    </script>
@endpush
