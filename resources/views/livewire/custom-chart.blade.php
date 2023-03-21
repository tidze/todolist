<div class="relative border border-cyan-600">
    <div class="text-amber-400 text-[10px]">
        <span wire:click="getTask()" class=" border border-amber-600 p-1 rounded hover:bg-yellow-500 hover:text-black cursor-pointer">getTask()</span>
        <br>
        <br>
        {{ '$startingDatepoint_unix ' . (isset($startingDatepoint_unix) ? $startingDatepoint_unix : 'Not Set') }}
        <br>
        {{ '$endingDatepoint_unix ' . (isset($endingDatepoint_unix) ? $endingDatepoint_unix : 'Not Set') }}
        <br>
        <br>
        {{ '$startingDate > x_unix ' . (isset($startingDate) ? $startingDate : 'Not Set') }}
        <br>
        <br>
        {{ '$endingDate > x_unix ' . (isset($endingDate) ? $endingDate : 'Not Set') }}
        <br>
        <pre>
            {{ '$$tasksGraphArray -->' . (isset($tasksGraphArray) ? print_r($tasksGraphArray) : 'Not Set') }}
        </pre>
        <div>
            {{-- for input date overlay to be clickable every where --}}
            <div id="startingDateContainer" class="inline-block border-2 border-sky-500">
                <input wire:ignore class="startingDate" type="date" class="" value="{{ $startingDate }}">
            </div>
            <input id="startingHourpoint" wire:model.defer="startingHourpoint" class="time startingHourpoint bg-black text-white text-center w-40" type="text" />
            {{-- <label for="startingHourpoint" class="text-teal-600">startingHourpoint</label> --}}
            <input name="startingDatepoint_unix" wire:model="startingDatepoint_unix" id="startingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]"
                type="text" value="0" />
            <lable for="startingDatepoint_unix">startingDatepoint_unix</lable>
            @error('startingDatepoint_unix')
                <span class="text-red-500 text-[9px]">{{ $message }}</span>
            @enderror
        </div>
        <div>
            {{-- for input date overlay to be clickable every where --}}
            <div id="endingDateContainer" class="inline-block border-2 border-sky-500">
                <input class="endingDate" type="date" class="" value="{{ $endingDate }}">
            </div>
            <input id="endingHourpoint" wire:model.defer="endingHourpoint" class="time endingHourpoint bg-black text-white text-center w-40" type="text" />
            <br>
            <label for="endingHourpoint" class="text-teal-600">endingHourpoint</label>
            <input name="endingDatepoint_unix" wire:model="endingDatepoint_unix" id="endingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]"
                type="text" value="0" />
            <lable for="endingDatepoint_unix">endingDatepoint_unix</lable>
            @error('endingDatepoint_unix')
                <span class="text-red-500 text-[9px]">{{ $message }}</span>
            @enderror
        </div>
    </div>
    {{-- Graph Chart --}}
    <div class="border border-orange-600 w-44 h-96 absolute top-0 right-0 box-border">
        @isset($tasksGraphArray)
            @foreach ($tasksGraphArray as $_task)
                <div style="@php print_r("top:". substr(100*abs((abs(substr($startingDatepoint_unix,0,10) -         $_task->starting_time)) / (abs(substr($startingDatepoint_unix,0,10)) - substr($endingDatepoint_unix,0,10))),0,2)    ."%" )@endphp;
                            @php print_r("height:". str_replace(".", "", substr(100*abs( (abs($_task->ending_time - $_task->starting_time))  /  (abs(substr($startingDatepoint_unix,0,10) - substr($endingDatepoint_unix,0,10)))  )  ,0,2 ) ) ."%")
                            @endphp"
                            {{-- The Starting point is 100% off by Y Axis so i added translate transform  --}}
                    class="-translate-y-full absolute w-full text-[9px] border border-cyan-800 bg-white"></div><br>
                    {{-- DO NOT DELETE THIS BELLOW CODE, AT ANY CIRCUMSTANCE. I FUCKED MYSELF TILL I FIXED IT. --}}
                    {{-- <div class="text-[9px] text-red-500 "> --}}
                        {{-- top --}}
                        {{-- {{ substr(100*abs((abs(substr($startingDatepoint_unix,0,10) -         $_task->starting_time)) / (abs(substr($startingDatepoint_unix,0,10)) - substr($endingDatepoint_unix,0,10))),0,2) }} --}}
                        {{-- height --}}
                        {{-- {{ str_replace(".", "", substr(100*abs( (abs($_task->ending_time - $_task->starting_time))  /  (abs(substr($startingDatepoint_unix,0,10) - substr($endingDatepoint_unix,0,10)))  )  ,0,2 ) ) }} --}}
                    {{-- </div> --}}
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
            giveDateObject("#startingDate", "#startingHourpoint", "#startingDatepoint_unix");
            document.getElementById("startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingHourpoint").dispatchEvent(new Event('input'));
        });
        $("#endingHourpoint").on("change", () => {
            giveDateObject("#endingDate", "#endingHourpoint", "#endingDatepoint_unix");
            document.getElementById("endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("endingHourpoint").dispatchEvent(new Event('input'));
            // console.log('endingHourpoint on change');
        });
        $("#startingDatepoint_unix").on("change", () => {
            giveDateObject("#startingDate", "#startingHourpoint", "#startingDatepoint_unix");
            document.getElementById("startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingHourpoint").dispatchEvent(new Event('input'));
        });
        $("#endingDatepoint_unix").on("change", () => {
            giveDateObject("#endingDate", "#endingHourpoint", "#endingDatepoint_unix");
            document.getElementById("endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("endingHourpoint").dispatchEvent(new Event('input'));
            // console.log('endingHourpoint on change');
        });

        // $('#getTasks').on('click', function() {
        //     console.log('getTasks');
        // });

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
