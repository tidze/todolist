<div class="relative border border-cyan-600">
    <div class="text-amber-400 text-[10px]">
        {{-- Components Debugger Information --}}
        <p class="text-yellow-500 text-[9px]">
            {{-- $c_startingDatepoint_unix = <span class="text-yellow-100">{{ isset($c_startingDatepoint_unix) ? $c_startingDatepoint_unix : 'Not Set' }}</span> <br> --}}
            {{-- $c_endingDatepoint_unix = <span class="text-yellow-100">{{ isset($c_endingDatepoint_unix) ? $c_endingDatepoint_unix : 'Not Set' }}</span><br> --}}
            {{-- $c_startingDate = <span class="text-yellow-100">{{ isset($c_startingDate) ? $c_startingDate : 'Not Set' }}</span><br> --}}
            {{-- $c_endingDate = <span class="text-yellow-100">{{ isset($c_endingDate) ? $c_endingDate : 'Not Set' }}</span><br> --}}
            {{-- $c_startingHourpoint = <span class="text-yellow-100">{{ isset($c_startingHourpoint) ? $c_startingHourpoint : 'Not Set' }}</span><br> --}}
            {{-- $c_endingHourpoint = <span class="text-yellow-100">{{ isset($c_endingHourpoint) ? $c_endingHourpoint : 'Not Set' }}</span><br> --}}
            {{-- $$c_tasksGraphArray --> =<pre class="text-yellow-100">{{ isset($c_tasksGraphArray) ? print_r($c_tasksGraphArray) : 'Not Set' }}</pre><br> --}}
            {{-- date_default_timezone_get=<span class="text-amber-100">{{ date_default_timezone_get() }}</span><br> --}}
            {{-- $flattened = <span class="text-yellow-100">{{ var_dump($flattened) }}</span><br> --}}
            {{-- timezone= <span class="text-yellow-100">{{ $timezone ?? 'Not Set' }}</span><br> --}}
        </p>
        <div class="relative z-20">
            {{-- <span id="c_customDebug" class="inline-block border border-amber-600 p-0.5 rounded hover:bg-yellow-500 hover:text-black cursor-pointer" wire:click>c_customDebug</span> --}}
            {{-- <br> --}}
            <div>
                <div id="c_targetDate_Container">
                    <input class="border-2 border-amber-700" id="c_targetDate" type="date" value="{{ date('Y-m-d', substr($c_startingDatepoint_unix, 0, 10) + 12600) }}">
                    <label class="text-amber-600 " for="c_targetDate">Date</label>
                </div>
                {{-- for input date overlay to be clickable every where --}}
                <div id="c_startingDateContainer" class="inline-block border-2 border-amber-500">
                    <input id="c_startingDate" wire:ignore type="date" value="{{ date('Y-m-d', substr($c_startingDatepoint_unix, 0, 10) + 12600) }}">
                </div>
                <input id="c_startingHourpoint" class="w-40 text-center text-white bg-black time" wire:model.defer="c_startingHourpoint" type="text">
                <label class="text-amber-600" for="c_startingHourpoint">Start</label>
                <input id="c_startingDatepoint_unix" name="c_startingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]" wire:model.defer="c_startingDatepoint_unix" type="hidden" value="0">
                {{-- <label for="c_startingDatepoint_unix">c_startingDatepoint_unix</label> --}}
                {{-- @error('c_startingDatepoint_unix') --}}
                {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
                {{-- @enderror --}}
            </div>
            <div>
                {{-- for input date overlay to be clickable every where --}}
                <div id="c_endingDateContainer" class="inline-block border-2 border-amber-500">
                    <input id="c_endingDate" type="date" value="{{ date('Y-m-d', substr($c_endingDatepoint_unix, 0, 10) + 12600) }}">
                </div>
                <input id="c_endingHourpoint" class="w-40 text-center text-white bg-black time" wire:model.defer="c_endingHourpoint" type="text">
                <label class="text-amber-600" for="c_endingHourpoint">End</label>
                <input id="c_endingDatepoint_unix" name="c_endingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]" wire:model.defer="c_endingDatepoint_unix" type="hidden" value="0">
                {{-- <label for="c_endingDatepoint_unix">c_endingDatepoint_unix</label> --}}
                {{-- @error('c_endingDatepoint_unix') --}}
                {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
                {{-- @enderror --}}
            </div>
        </div>
    </div>
    {{-- Graph Chart --}}
    <div class="flex flex-col">
        <div class="self-center relative z-10 text-amber-600 text-[9px] w-60 text-center
        inline-block border border-amber-600 p-0.5 rounded
        hover:bg-yellow-500 hover:text-black cursor-pointer"
            wire:click="getTask()">
            Daily Report</div>

        <div id="c_flattenTasksGraph"
            class="self-center relative z-10 text-amber-600 text-[9px] w-60 text-center
            inline-block border border-amber-600 p-0.5 rounded
            hover:bg-yellow-500 hover:text-black cursor-pointer"
            wire:click="flattenTasksGraph">
            Flat
        </div>
        <div class="flex justify-center overflow-x-auto">
            <div class=" relative p-2 border-2 border-red-400 border-opacity-0 ">
                <div class="border-2 border-orange-800 border-opacity-50 w-60 h-[50vh] relative right-0 box-border">
                    {{-- startTimepointHandle --}}
                    <div class="w-[30%] h-[2px] bg-amber-700 border-t-2 border-t-amber-700 absolute right-full">
                        <div class="relative flex flex-row justify-center items-center w-[140px] -translate-x-2/4 -translate-y-2/4 -rotate-45 h-10">
                            <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-start">
                                <div class="w-[1px] h-5 translate-x-2/4 translate-y-0 rotate-45 flex justify-end items-center">
                                    <pre class="text-amber-200 text-[9px] inline-block">{{ date('Y-m-d H:i', substr($c_startingDatepoint_unix, 0, 10) + 12600) }} </pre>
                                </div>
                            </div>
                            <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-start invisible"></div>
                        </div>
                    </div>
                    {{-- endTimepointHandle --}}
                    <div class="w-[30%] h-px bg-amber-700 border-t-2 border-t-amber-700 absolute top-full left-full">
                        <div class="relative flex flex-row justify-center items-center w-[140px] -translate-x-2/4 -translate-y-2/4 -rotate-45 h-10 -right-full">
                            <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-end invisible"></div>
                            <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-end">
                                <div class="w-[3px] h-5 translate-x-2/4 translate-y-0 rotate-45 flex justify-start items-center">
                                    <pre class="text-amber-200 text-[9px]"> {{ date('Y-m-d H:i', substr($c_endingDatepoint_unix, 0, 10) + 12600) }}</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    @isset($c_tasksGraphArray)
                        @foreach ($c_tasksGraphArray as $_task)
                            <div class="taskGraphItem box-border {{ $_task['translate'] ?? '' }} {{ $_task['position'] ?? '' }} w-full text-[9px] border border-yellow-400 border-opacity-70"
                                style=" {{ $_task['top'] ?? '' }} ; {{ $_task['height'] ?? '' }};" {{-- The Starting point is 100% off by Y Axis so i added translate transform --}}>
                                {{-- time indicator --}}
                                <div class="box-border border border-b-transparent border-r-transparent border-l-transparent border-t-yellow-400 h-[20px] w-1/5 absolute -left-[20%]">
                                    <div class="flex justify-end">
                                        <div class="mx-1">{{ date('H:i', $_task['starting_time'] + 12600) }}</div>
                                        <div class="">{{ date('H:i', $_task['ending_time'] + 12600) }}</div>
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
            setDateForToday("#c_targetDate");
            copyDate("#c_targetDate", "#c_startingDate");
            copyDate("#c_targetDate", "#c_endingDate");
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
    </script>
@endpush
