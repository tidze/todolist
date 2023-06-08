<div class="relative border-4 border-emerald-700">
    <div wire:loading class="bg-blue-400 bg-opacity-30 animate-pulse absolute w-full h-full z-0 "></div>
    <div class="relative z-50">

        <div>
            {{-- Components Debugger Information --}}
            <p class="text-teal-600 text-[12px]">
                {{-- $x_startingDatepoint_unix = <span class="text-teal-100">{{ isset($x_startingDatepoint_unix) ? $x_startingDatepoint_unix .' '. date('Y-m-d H:i',substr($x_startingDatepoint_unix,0,10)) : 'Not Set' }}</span> <br> --}}
                {{-- $x_endingDatepoint_unix = <span class="text-teal-100">{{ isset($x_endingDatepoint_unix) ? $x_endingDatepoint_unix .' '. date('Y-m-d H:i',substr($x_endingDatepoint_unix,0,10)): 'Not Set' }}</span><br> --}}
                {{-- $x_startingDate = <span class="text-teal-100">{{ isset($x_startingDate) ? $x_startingDate : 'Not Set' }}</span><br> --}}
                {{-- $x_endingDate = <span class="text-teal-100">{{ isset($x_endingDate) ? $x_endingDate : 'Not Set' }}</span><br> --}}
                {{-- $x_startingHour = <span class="text-teal-100">{{ isset($x_startingHour) ? $x_startingHour : 'Not Set' }}</span><br> --}}
                {{-- $x_endingHour = <span class="text-teal-100">{{ isset($x_endingHour) ? $x_endingHour : 'Not Set' }}</span><br> --}}
                {{-- $x_tasksGraphArray --> = <pre class="text-teal-100 text-[10px]">{{ isset($x_tasksGraphArray) ? print_r($x_tasksGraphArray) : 'Not Set' }}</pre><br> --}}
                {{-- $seperatedTasksByDay --> =''  <pre class="text-teal-100 text-[10px]">{{ isset($seperatedTasksByDay) ? print_r($seperatedTasksByDay) : 'Not Set' }}</pre><br> --}}
                {{-- $seperatedCategoriesByDay_Sum --> =''  <pre class="text-teal-100 text-[10px]">{{ isset($seperatedCategoriesByDay_Sum) ? print_r($seperatedCategoriesByDay_Sum) : 'Not Set' }}</pre><br> --}}
                {{-- $x_flattened = <span class="text-teal-100">{{ var_dump($x_flattened) }}</span><br> --}}
            </p>
            <div class="relative z-20 flex flex-col items-center text-white">
                {{-- Component x_startingTimepoint --}}
                <div class="flex w-full">
                    {{-- for input date overlay to be clickable every where --}}
                    <div id="x_startingDateContainer" class="basis-2/5 inline-block border rounded-xl border-transparent">
                        <input id="x_startingDate" class="border-2 rounded-xl border-gray-500 bg-gray-800" type="date" value="{{ date('Y-m-d', substr($x_startingDatepoint_unix, 0, 10) + 12600) }}">
                    </div>
                    <div class="basis-2/5 flex">
                        <input class="inline-block w-40 bg-black text-center startingTimepoint border-2 h-full rounded-xl border-gray-500" id="x_startingHour" wire:model.defer="x_startingHour" type="text">
                    </div>
                    <label class="basis-1/5 self-center" for="x_startingHour">Start</label>
                    <input id="x_startingDatepoint_unix" name="x_startingDatepoint_unix" class="bg-black text-center w-52 p-0 text-[10px]" wire:model.defer="x_startingDatepoint_unix" type="hidden" value="0">
                    {{-- <label for="x_startingDatepoint_unix">x_startingDatepoint_unix</label> --}}
                    {{-- @error('x_startingDatepoint_unix') --}}
                    {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
                    {{-- @enderror --}}
                </div>

                {{-- Component x_startingTimepoint --}}
                <div class="flex w-full">
                    {{-- for input date overlay to be clickable every where --}}
                    <div id="x_endingDateContainer" class="basis-2/5 inline-block border rounded-xl border-transparent">
                        <input id="x_endingDate" class="border-2 rounded-xl border-gray-500 bg-gray-800" type="date" value="{{ date('Y-m-d', substr($x_endingDatepoint_unix, 0, 10) + 12600) }}">
                    </div>
                    <div class="basis-2/5 flex">
                        <input class="inline-block w-40 bg-black text-center endingTimepoint border-2 h-full rounded-xl border-gray-500" id="x_endingHour" wire:model.defer="x_endingHour" type="text">
                    </div>
                    <label class="basis-1/5 self-center" for="x_endingHour">End</label>
                    <input id="x_endingDatepoint_unix" name="x_endingDatepoint_unix" class="bg-black text-center w-52 p-0 text-[10px]" wire:model.defer="x_endingDatepoint_unix" type="hidden" value="0">
                    {{-- <label for="x_startingDatepoint_unix">x_startingDatepoint_unix</label> --}}
                    {{-- @error('x_startingDatepoint_unix') --}}
                    {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
                    {{-- @enderror --}}
                </div>
                <div class="flex flex-row justify-around mt-1 w-full flex-wrap">
                    <div class="p-2 text-[14px] inline-block border border-emerald-600 text-emerald-500 rounded hover:bg-emerald-600 hover:text-black cursor-pointer" wire:click="getTask()">Custom Days Report</div>
                    <div class="p-2 text-[14px] inline-block border border-gray-500 text-gray-500 rounded cursor-pointer" wire:click="" disabled>7 Days Report</div>
                    <div class="p-2 text-[14px] inline-block border border-gray-500 text-gray-500 rounded cursor-pointer" wire:click="" disabled>30 Days Report
                    </div>
                </div>
            </div>
            {{-- <span id="x_customDebug" class="inline-block border border-amber-600 p-0.5 rounded hover:bg-yellow-500 hover:text-black cursor-pointer" wire:click>x_customDebug</span> --}}
        </div>

        {{-- Loading Animations --}}
        {{-- <div class="w-full p-1" wire:loading> --}}
        {{-- <div class="text-blue-400 i nline-block  border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Loading Custom Graph X ...</div> --}}
        {{-- </div> --}}

        {{-- Days Graph Chart --}}
        <div class="flex flex-col items-center p-1 w-full overflow-x-auto">
            {{-- <div id="x_flattenTasksGraph" class="relative z-10 text-amber-600 text-[9px] w-60 text-center
            inline-block border border-amber-600 p-0.5 rounded
            hover:bg-yellow-500 hover:text-black cursor-pointer" wire:click="x_flattenTasksGraph">
            Flat
        </div> --}}
            @isset($seperatedTasksByDay)
                @foreach ($seperatedTasksByDay as $day => $tasksOfDay)
                    <div class="border-2 border-cyan-900 h-[6vh] flex flex-row relative right-0 box-border border-opacity-100 w-full">
                        <div class="flex flex-row w-full">
                            <div class="text-[10px] text-green-400">{{ date('Y-m-d', substr($x_startingDatepoint_unix, 0, 10) + 12600 + 86400 * (count($seperatedTasksByDay) - ($day + 1))) }}</div>
                            <pre> </pre>
                            <div class="text-[10px] text-teal-400">{{ date('H:i', substr($x_startingDatepoint_unix, 0, 10) + 12600 + 86400 * ($day + 1)) }}</div>
                            <div class="ml-auto text-[10px] text-green-400">{{ date('Y-m-d', substr($x_endingDatepoint_unix, 0, 10) + 12600 + 86400 * -$day) }}</div>
                            <pre> </pre>
                            <div class="text-[10px] text-teal-400" style>{{ date('H:i', substr($x_endingDatepoint_unix, 0, 10) + 12600 + 86400 * -$day) }}</div>
                        </div>
                        {{-- If the task['done'] is true, then enable grid background. --}}
                        @foreach ($tasksOfDay as $_task)
                            @if ($_task['done'])
                                <div class="
                        border
                        w-1/2
                        h-full
                        flex
                        flex-row
                        absolute
                        box-border"
                                    style="
                        {{ $_task['width'] }};
                        {{ $_task['left'] }};
                        border-color: {{ $_task['color'] }};
                        background: repeating-linear-gradient(-45deg, {{ $_task['color'] }}, {{ $_task['color'] }} 2px, #ffffff00 0, #ffffff00 6px);">
                                </div>
                            @else
                                <div class="
                        border
                        w-1/2
                        h-full
                        flex
                        flex-row
                        absolute
                        box-border"
                                    style="
                                {{ $_task['width'] }};
                                {{ $_task['left'] }};
                                border-color: {{ $_task['color'] }};
                                background: repeating-linear-gradient(-90deg, {{ $_task['color'] }}, {{ $_task['color'] }} 2px, #ffffff00 0, #ffffff00 6px);">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="text-white text-[12px] flex flex-wrap justify-start w-full">
                        @isset($seperatedCategoriesByDay_Sum)
                            @foreach($seperatedCategoriesByDay_Sum[$day] as $category => $duration)
                                <div class="">
                                    <span class="whitespace-nowrap">{{$category}}</span>
                                    <span class="text-amber-400">{{substr($duration/60/60,0,4)}}</span> h
                                    <span>/&nbsp;</span>
                                </div>
                            @endforeach
                        @endisset
                    </div>

                @endforeach
            @endisset
        </div>
    </div>

</div>

@push('script')
    <script>
        // console.log('CustomChart Script Loaded.')
        Livewire.hook('component.initialized', (component) => {
            $('#x_startingHour').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('#x_endingHour').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });

        Livewire.hook('element.updated', (el, component) => {
            $('#x_startingHour').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('#x_endingHour').clockTimePicker({
                autosize: true,
                onModeSwitch: function(MINUTE) {},
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });
        $("#x_startingHour").on("change", () => {
            giveDateObject("#x_startingDate", "#x_startingHour", "#x_startingDatepoint_unix");
            document.getElementById("x_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_startingHour").dispatchEvent(new Event('input'));
        });

        $("#x_endingHour").on("change", () => {
            giveDateObject("#x_endingDate", "#x_endingHour", "#x_endingDatepoint_unix");
            document.getElementById("x_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_endingHour").dispatchEvent(new Event('input'));
            // console.log('endingHourpoint on change');
        });
        $("#x_startingDatepoint_unix").on("change", () => {
            giveDateObject("#x_startingDate", "#x_startingHour", "#x_startingDatepoint_unix");
            document.getElementById("x_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_startingHour").dispatchEvent(new Event('input'));
        });
        $("#x_endingDatepoint_unix").on("change", () => {
            giveDateObject("#x_endingDate", "#x_endingHour", "#x_endingDatepoint_unix");
            document.getElementById("x_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_endingHour").dispatchEvent(new Event('input'));
            // console.log('endingHourpoint on change');
        });
        $('#x_flattenTasksGraph').on('click', function() {
            console.log('x_flattenTasksGraph');
        });

        $('#x_customDebug').on('click', function() {
            console.group("x_customDebug");
            let date = new Date(parseInt($('#x_startingDatepoint_unix').val()));
            let date2 = new Date(parseInt($('#x_endingDatepoint_unix').val()));
            console.log('x_startingDatepoint_unix', date, $('#x_startingDatepoint_unix').val());
            console.log('x_endingDatepoint_unix', date2, $('#x_endingDatepoint_unix').val());
            console.groupEnd();
        });

        $("#x_startingDate").on("change", () => {
            giveDateObject("#x_startingDate", "#x_startingHour", "#x_startingDatepoint_unix");
            document.getElementById("x_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_startingHour").dispatchEvent(new Event('input'));
            console.log('x_startingDate change');

        });

        $("#x_endingDate").on("change", () => {
            giveDateObject("#x_endingDate", "#x_endingHour", "#x_endingDatepoint_unix");
            document.getElementById("x_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_endingHour").dispatchEvent(new Event('input'));

        });
    </script>
@endpush
