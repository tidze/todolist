<div class="relative border border-cyan-600">
    <div class="text-amber-500 text-[10px]">
        {{-- Components Debugger Information --}}
        <p class="text-teal-600 text-[9px]">
            $startingDatepoint_unix = <span class='text-teal-100'>{{ isset($startingDatepoint_unix) ? $startingDatepoint_unix : 'Not Set' }}</span> <br>
            $endingDatepoint_unix = <span class="text-teal-100">{{ isset($endingDatepoint_unix) ? $endingDatepoint_unix : 'Not Set' }}</span><br>
            $startingDate = <span class="text-teal-100">{{ isset($startingDate) ? $startingDate : 'Not Set' }}</span><br>
            $endingDate = <span class="text-teal-100">{{ isset($endingDate) ? $endingDate : 'Not Set' }}</span><br>
            $startingHourpoint = <span class="text-teal-100">{{ isset($startingHourpoint) ? $startingHourpoint : 'Not Set' }}</span><br>
            $endingHourpoint = <span class="text-teal-100">{{ isset($endingHourpoint) ? $endingHourpoint : 'Not Set' }}</span><br>
            {{-- $$tasksGraphArray --> = <pre class="text-teal-100">{{ isset($tasksGraphArray) ? print_r($tasksGraphArray) : 'Not Set' }}</pre><br> --}}
            {{-- $flattened = <span class="text-teal-100">{{ var_dump($flattened) }}</span><br> --}}
        </p>
        <div class="relative z-20">
            <span wire:click="getTask()" class="inline-block border border-amber-600 p-0.5 rounded hover:bg-yellow-500 hover:text-black cursor-pointer">getTask()</span>
            <span wire:click="" id="customDebug" class="inline-block border border-amber-600 p-0.5 rounded hover:bg-yellow-500 hover:text-black cursor-pointer">customDebug</span>
            <br>
            <div>
                {{-- for input date overlay to be clickable every where --}}
                <div id="startingDateContainer" class="inline-block border-2 border-sky-500">
                    <input wire:ignore class="startingDate" type="date" class="" value="{{ date('Y-m-d',substr($startingDatepoint_unix,0,10)) }}">
                </div>
                <input id="startingHourpoint" wire:model.defer="startingHourpoint" class="w-40 text-center text-white bg-black time startingHourpoint" type="text" />
                <label for="startingHourpoint" class="text-teal-600">startingHourpoint</label>
                <input name="startingDatepoint_unix" wire:model.defer="startingDatepoint_unix" id="startingDatepoint_unix"
                    class="bg-black text-white text-center w-52 p-0 text-[10px]" type="text" value="0" />
                <lable for="startingDatepoint_unix">startingDatepoint_unix</lable>
                @error('startingDatepoint_unix')
                    <span class="text-red-500 text-[9px]">{{ $message }}</span>
                @enderror
            </div>
            <div>
                {{-- for input date overlay to be clickable every where --}}
                <div id="endingDateContainer" class="inline-block border-2 border-sky-500">
                    <input class="endingDate" type="date" class="" value="{{  date('Y-m-d',substr($endingDatepoint_unix,0,10)) }}">
                </div>
                <input id="endingHourpoint" wire:model.defer="endingHourpoint" class="w-40 text-center text-white bg-black time endingHourpoint" type="text" />
                <label for="endingHourpoint" class="text-teal-600">endingHourpoint</label>
                <input name="endingDatepoint_unix" wire:model.defer="endingDatepoint_unix" id="endingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]"
                    type="text" value="0" />
                <lable for="endingDatepoint_unix">endingDatepoint_unix</lable>
                @error('endingDatepoint_unix')
                    <span class="text-red-500 text-[9px]">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    {{-- Graph Chart --}}
    <div class="flex flex-col items-center p-1">
        {{-- <div id="flattenTasksGraph" wire:click="flattenTasksGraph"
            class="relative z-10 text-amber-600 text-[9px] w-60 text-center
            inline-block border border-amber-600 p-0.5 rounded
            hover:bg-yellow-500 hover:text-black cursor-pointer">
            Flat
        </div> --}}
            @isset($seperatedTasks)
                @foreach ($seperatedTasks as $index => $tasksOfDay)
                    <div style="width:700px" class="border-2 border-cyan-900 h-[6vh] flex flex-row relative right-0 box-border border-opacity-100 ">
                        <div class="text-[10px] text-green-400">{{date('Y-m-d',substr($startingDatepoint_unix,0,10)+(86400*($index+1)))}}</div>
                        <pre> </pre>
                        <div class="text-[10px] text-teal-400">{{$startingHourpoint}}</div>
                        <div class="absolute right-0 text-[10px] text-teal-400">{{" ".$endingHourpoint}}</div>
                        @foreach ($tasksOfDay as $index =>$_task)
                            <div style="{{ ($_task['width']) }};{{($_task['left'])}}" class="border border-fuchsia-400 w-1/2 h-full flex flex-row absolute box-border"></div>
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
            $('.startingHourpoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('.endingHourpoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });

        Livewire.hook('element.updated', (el, component) => {
            $('.startingHourpoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('.endingHourpoint').clockTimePicker({
                autosize: true,
                onModeSwitch: function(MINUTE) {},
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });
        $("#startingHourpoint").on("change", () => {
            giveDateObject(".startingDate", "#startingHourpoint", "#startingDatepoint_unix");
            document.getElementById("startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingHourpoint").dispatchEvent(new Event('input'));
        });

        $("#endingHourpoint").on("change", () => {
            giveDateObject(".endingDate", "#endingHourpoint", "#endingDatepoint_unix");
            document.getElementById("endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("endingHourpoint").dispatchEvent(new Event('input'));
            // console.log('endingHourpoint on change');
        });
        $("#startingDatepoint_unix").on("change", () => {
            giveDateObject(".startingDate", "#startingHourpoint", "#startingDatepoint_unix");
            document.getElementById("startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingHourpoint").dispatchEvent(new Event('input'));
        });
        $("#endingDatepoint_unix").on("change", () => {
            giveDateObject(".endingDate", "#endingHourpoint", "#endingDatepoint_unix");
            document.getElementById("endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("endingHourpoint").dispatchEvent(new Event('input'));
            // console.log('endingHourpoint on change');
        });
        $('#flattenTasksGraph').on('click', function() {
            console.log('flattenTasksGraph');
        });

        $('#customDebug').on('click', function() {
            console.group("customDebug");
            let date = new Date(parseInt($('#startingDatepoint_unix').val()));
            let date2 = new Date(parseInt($('#endingDatepoint_unix').val()));
            console.log('startingDatepoint_unix', date, $('#startingDatepoint_unix').val());
            console.log('endingDatepoint_unix', date2, $('#endingDatepoint_unix').val());
            console.groupEnd();
        });

        $(".startingDate").on("change", () => {
            giveDateObject(".startingDate", "#startingHourpoint", "#startingDatepoint_unix");
            document.getElementById("startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingHourpoint").dispatchEvent(new Event('input'));

        });

        $(".endingDate").on("change", () => {
            giveDateObject(".endingDate", "#endingHourpoint", "#endingDatepoint_unix");
            document.getElementById("endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("endingHourpoint").dispatchEvent(new Event('input'));

        });
    </script>
@endpush
