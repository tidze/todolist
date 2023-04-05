<div class="relative border border-emerald-700">
    <div>
        {{-- Components Debugger Information --}}
        <p class="text-teal-600 text-[9px]">
            {{-- $x_startingDatepoint_unix = <span class="text-teal-100">{{ isset($x_startingDatepoint_unix) ? $x_startingDatepoint_unix : 'Not Set' }}</span> <br> --}}
            {{-- $x_endingDatepoint_unix = <span class="text-teal-100">{{ isset($x_endingDatepoint_unix) ? $x_endingDatepoint_unix : 'Not Set' }}</span><br> --}}
            {{-- $x_startingDate = <span class="text-teal-100">{{ isset($x_startingDate) ? $x_startingDate : 'Not Set' }}</span><br> --}}
            {{-- $x_endingDate = <span class="text-teal-100">{{ isset($x_endingDate) ? $x_endingDate : 'Not Set' }}</span><br> --}}
            {{-- $x_startingHourpoint = <span class="text-teal-100">{{ isset($x_startingHourpoint) ? $x_startingHourpoint : 'Not Set' }}</span><br> --}}
            {{-- $x_endingHourpoint = <span class="text-teal-100">{{ isset($x_endingHourpoint) ? $x_endingHourpoint : 'Not Set' }}</span><br> --}}
            {{-- $$x_tasksGraphArray --> = <pre class="text-teal-100">{{ isset($x_tasksGraphArray) ? print_r($x_tasksGraphArray) : 'Not Set' }}</pre><br> --}}
            {{-- $x_flattened = <span class="text-teal-100">{{ var_dump($x_flattened) }}</span><br> --}}
        </p>
        <div class="relative z-20 flex flex-col items-center" >
            <div>
                {{-- for input date overlay to be clickable every where --}}
                <div id="x_startingDateContainer" class="text-emerald-500 inline-block border-2 border-sky-500">
                    <input id="x_startingDate" wire:ignore type="date" value="{{ date('Y-m-d', (substr($x_startingDatepoint_unix, 0, 10)+12600)) }}">
                </div>
                <input id="x_startingHourpoint" class="w-40 text-center text-white bg-black time" wire:model.defer="x_startingHourpoint" type="text">
                <label class="text-emerald-600" for="x_startingHourpoint">Start</label>
                <input id="x_startingDatepoint_unix" name="x_startingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]" wire:model.defer="x_startingDatepoint_unix" type="hidden" value="0">
                {{-- <label for="x_startingDatepoint_unix">x_startingDatepoint_unix</label> --}}
                {{-- @error('x_startingDatepoint_unix') --}}
                {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
                {{-- @enderror --}}
            </div>
            <div>
                {{-- for input date overlay to be clickable every where --}}
                <div id="x_endingDateContainer" class="text-emerald-500 inline-block border-2 border-sky-500">
                    <input id="x_endingDate" type="date" value="{{ date('Y-m-d', (substr($x_endingDatepoint_unix, 0, 10)+12600)) }}">
                </div>
                <input id="x_endingHourpoint" class="w-40 text-center text-white bg-black time" wire:model.defer="x_endingHourpoint" type="text">
                <label class="text-emerald-600" for="x_endtingHourpoint">End</label>
                <input id="x_endingDatepoint_unix" name="x_endingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]" wire:model.defer="x_endingDatepoint_unix" type="hidden" value="0">
                {{-- <label for="x_endingDatepoint_unix">x_endingDatepoint_unix</label> --}}
                {{-- @error('x_endingDatepoint_unix') --}}
                {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
                {{-- @enderror --}}
            </div>
            <div class="inline-block border border-emerald-600 text-emerald-500 p-0.5 rounded hover:bg-emerald-600 hover:text-black cursor-pointer" wire:click="getTask()">Days Report</div>
        </div>
        {{-- <span id="x_customDebug" class="inline-block border border-amber-600 p-0.5 rounded hover:bg-yellow-500 hover:text-black cursor-pointer" wire:click>x_customDebug</span> --}}
    </div>
    {{-- Graph Chart --}}
    <div class="flex flex-col items-center p-1">
        {{-- <div id="x_flattenTasksGraph" class="relative z-10 text-amber-600 text-[9px] w-60 text-center
            inline-block border border-amber-600 p-0.5 rounded
            hover:bg-yellow-500 hover:text-black cursor-pointer" wire:click="x_flattenTasksGraph">
            Flat
        </div> --}}
        @isset($x_seperatedTasks)
            @foreach ($x_seperatedTasks as $index => $tasksOfDay)
                <div class="border-2 border-cyan-900 h-[6vh] flex flex-row relative right-0 box-border border-opacity-100 " style="width:700px">
                    <div class="flex flex-row w-full">
                        <div class="text-[10px] text-green-400">{{ date('Y-m-d', substr($x_startingDatepoint_unix, 0, 10) + 86400 * ($index + 1)) }}</div>
                        <pre> </pre>
                        <div class="text-[10px] text-teal-400">{{ $x_startingHourpoint }}</div>
                        <div class="ml-auto text-[10px] text-green-400">{{ date('Y-m-d', substr($x_endingDatepoint_unix, 0, 10) + 86400 * (- count($x_seperatedTasks) + $index + 2)) }}</div>
                        <pre> </pre>
                        <div class="text-[10px] text-teal-400" style>{{ ' ' . $x_endingHourpoint }}</div>
                    </div>
                    @foreach ($tasksOfDay as $index => $_task)
                        <div class="border border-fuchsia-400 w-1/2 h-full flex flex-row absolute box-border" style="{{ $_task['width'] }};{{ $_task['left'] }}"></div>
                    @endforeach
                </div>
            @endforeach
        @endisset
    </div>
</div>

@push('script')
    <script>
        console.log('CustomChart Script Loaded.')
        Livewire.hook('component.initialized', (component) => {
            $('#x_startingHourpoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('#x_endingHourpoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });

        Livewire.hook('element.updated', (el, component) => {
            $('#x_startingHourpoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('#x_endingHourpoint').clockTimePicker({
                autosize: true,
                onModeSwitch: function(MINUTE) {},
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });
        $("#x_startingHourpoint").on("change", () => {
            giveDateObject("#x_startingDate", "#x_startingHourpoint", "#x_startingDatepoint_unix");
            document.getElementById("x_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_startingHourpoint").dispatchEvent(new Event('input'));
        });

        $("#x_endingHourpoint").on("change", () => {
            giveDateObject("#x_endingDate", "#x_endingHourpoint", "#x_endingDatepoint_unix");
            document.getElementById("x_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_endingHourpoint").dispatchEvent(new Event('input'));
            // console.log('endingHourpoint on change');
        });
        $("#x_startingDatepoint_unix").on("change", () => {
            giveDateObject("#x_startingDate", "#x_startingHourpoint", "#x_startingDatepoint_unix");
            document.getElementById("x_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_startingHourpoint").dispatchEvent(new Event('input'));
        });
        $("#x_endingDatepoint_unix").on("change", () => {
            giveDateObject("#x_endingDate", "#x_endingHourpoint", "#x_endingDatepoint_unix");
            document.getElementById("x_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_endingHourpoint").dispatchEvent(new Event('input'));
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
            giveDateObject("#x_startingDate", "#x_startingHourpoint", "#x_startingDatepoint_unix");
            document.getElementById("x_startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_startingHourpoint").dispatchEvent(new Event('input'));
            console.log('x_startingDate change');

        });

        $("#x_endingDate").on("change", () => {
            giveDateObject("#x_endingDate", "#x_endingHourpoint", "#x_endingDatepoint_unix");
            document.getElementById("x_endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("x_endingHourpoint").dispatchEvent(new Event('input'));

        });
    </script>
@endpush
