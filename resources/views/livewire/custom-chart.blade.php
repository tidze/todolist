<div class="relative border-4 border-yellow-900 box-border text-white text-[10px]">
    {{-- Components Debugger Information --}}
    <div class="text-yellow-500 text-[11px] w-full">
        {{-- date_default_timezone_get=<span class="text-amber-100">{{ date_default_timezone_get() }}</span><br> --}}
        {{-- $c_startingDatepoint_unix = <span class="text-yellow-100">{{ isset($c_startingDatepoint_unix) ? substr($c_startingDatepoint_unix,0,10)+12600 . ' ' . date('Y-m-d H:i', substr($c_startingDatepoint_unix,0,10)+12600) : 'Not Set' }}</span> <br> --}}
        {{-- $c_endingDatepoint_unix = <span class="text-yellow-100">{{ isset($c_endingDatepoint_unix) ? substr($c_endingDatepoint_unix,0,10)+12600 . ' ' . date('Y-m-d H:i', substr($c_endingDatepoint_unix,0,10)+12600) : 'Not Set' }}</span><br> --}}
        {{-- $c_startingDate = <span class="text-yellow-100">{{ isset($c_startingDate) ? $c_startingDate : 'Not Set' }}</span><br> --}}
        {{-- $c_endingDate = <span class="text-yellow-100">{{ isset($c_endingDate) ? $c_endingDate : 'Not Set' }}</span><br> --}}
        {{-- $c_startingHourpoint = <span class="text-yellow-100">{{ isset($c_startingHourpoint) ? $c_startingHourpoint : 'Not Set' }}</span><br> --}}
        {{-- $c_endingHourpoint = <span class="text-yellow-100">{{ isset($c_endingHourpoint) ? $c_endingHourpoint : 'Not Set' }}</span><br> --}}
        {{-- $c_tasksGraphArray --> =<pre class="text-yellow-100">{{ isset($c_tasksGraphArray) ? print_r($c_tasksGraphArray) : 'Not Set' }}</pre><br> --}}
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
                class="flex-1 px-3 py-3 m-1 text-center text-sm font-medium text-gray-900
            focus:outline-none bg-white border border-gray-200 rounded-xl
          hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
          focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
          dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
          dark:hover:bg-gray-700"
                wire:click="getTask">
                Daily Report</button>
            <button id="c_flattenTasksGraph"
                class="flex-1 px-3 py-3 m-1 text-center text-sm font-medium text-gray-900
                focus:outline-none bg-white border border-gray-200 rounded-xl
              hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
              focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
              dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
              dark:hover:bg-gray-700"
                wire:click="flattenTasksGraph">
                Flat
            </button>
            <button id=""
                class="flex-1 px-3 py-3 m-1 text-center text-sm font-medium text-gray-900
                focus:outline-none bg-white border border-gray-200 rounded-xl
              hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
              focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
              dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
              dark:hover:bg-gray-700"
                wire:click="getTimeAndDate">
                getTimeAndDate
            </button>
        </div>

        {{-- Loading Animation For When Http Request is happening. --}}
        <div class="p-1" wire:loading wire:target="getTask">
            <div class="text-blue-400 border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Loading Custom Graph ...</div>
        </div>
        <div class="p-1" wire:loading wire:target="flattenTasksGraph">
            <div class="text-blue-400 border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Flattening Tasks ...</div>
        </div>
        <div class="p-1" wire:loading wire:target="prevPeriod">
            <div class="text-blue-400 border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Going Previous Period ...</div>
        </div>
        <div class="p-1" wire:loading wire:target="nextPeriod">
            <div class="text-blue-400 border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Going Next Period ...</div>
        </div>
    </div>
    {{-- Dayily Graph Chart --}}
    <div class="flex flex-col">
        <div class="flex justify-end">
            <div class="relative pt-11 pb-2 px-9 border-2 border-red-400 border-opacity-0">
                <div class="border-2 border-orange-800 border-opacity-50 w-52 h-[78vh] relative right-0 box-border">
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
                    @isset($c_tasksGraphArray)
                        @foreach ($c_tasksGraphArray as $_task)
                            <div class="flex taskGraphItem box-border {{ $_task['translate'] ?? '' }} {{ $_task['position'] ?? '' }} w-full text-[9px] border-2 border-opacity-70"
                                style=" {{ $_task['top'] ?? '' }} ;
                                        {{ $_task['height'] ?? '' }};
                                        background: repeating-linear-gradient(-45deg, {{ $_task['color'] }}, {{ $_task['color'] }} 2px, #ffffff00 0, #ffffff00 6px);
                                        border-color: {{ $_task['color'] }}"
                                {{-- The Starting point is 100% off by Y Axis so i added translate transform --}}>

                                <div class="absolute flex flex-row -translate-x-full ">

                                    <div class="text-white-500 text-[14px] -translate-y-[40%] mx-1">
                                        {{ $_task['description'] }}
                                    </div>

                                    {{-- time indicator --}}
                                    <div class="box-border border border-b-transparent border-r-transparent border-l-transparent border-t-yellow-400 pr-2">
                                        <div class="flex justify-between bg-gray-500 bg-opacity-60 rounded-sm text-[12px]">
                                            <div class="mx-0.5">{{ date('H:i', $_task['starting_time'] + 12600) }}</div>
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
    </div>
</div>

@push('script')
    <script>
        console.log('CustomChart Script Loaded.')
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
