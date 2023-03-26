<div class="relative border border-cyan-600">
    <div class="text-amber-400 text-[10px]">
        {{-- Components Debugger Information --}}
        <p class="text-amber-600 text-[9px]">
            $startingDatepoint_unix = <span class='text-amber-100'>{{ isset($startingDatepoint_unix) ? $startingDatepoint_unix : 'Not Set' }}</span> <br>
            $endingDatepoint_unix = <span class="text-amber-100">{{ isset($endingDatepoint_unix) ? $endingDatepoint_unix : 'Not Set' }}</span><br>
            $startingDate > x_unix = <span class="text-amber-100">{{ isset($startingDate) ? $startingDate : 'Not Set' }}</span><br>
            $endingDate > x_unix = <span class="text-amber-100">{{ isset($endingDate) ? $endingDate : 'Not Set' }}</span><br>
            $startingHourpoint = <span class="text-amber-100">{{ isset($startingHourpoint) ? $startingHourpoint : 'Not Set' }}</span><br>
            $endingHourpoint = <span class="text-amber-100">{{ isset($endingHourpoint) ? $endingHourpoint : 'Not Set' }}</span><br>
            $$tasksGraphArray --> = <pre class="text-amber-100">{{ isset($tasksGraphArray) ? print_r($tasksGraphArray) : 'Not Set' }}</pre><br>
        </p>
        <div class="relative z-10">
            <span wire:click="getTask()" class="inline-block border border-amber-600 p-0.5 rounded hover:bg-yellow-500 hover:text-black cursor-pointer">getTask()</span>
            <br>
            <div>
                {{-- for input date overlay to be clickable every where --}}
                <div id="startingDateContainer" class="inline-block border-2 border-sky-500">
                    <input wire:ignore class="startingDate" type="date" class="" value="{{ $startingDate }}">
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
                    <input class="endingDate" type="date" class="" value="{{ $endingDate }}">
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
    <div class="flex flex-col items-center">
        <div id="flattenTasksGraph" wire:click="calcTaskTopOffset"
            class="relative z-10 text-amber-600 text-[9px] w-60 text-center inline-block border border-amber-600 p-0.5
            rounded hover:bg-yellow-500 hover:text-black cursor-pointer">
            Sort</div>
        <div>
            <div class="border border-orange-600 w-60 h-[87vh] relative right-0 box-border">
                {{-- <div class="relative w-20 h-20 border border-red-500 top-10 "></div> --}}
                {{-- <div class="relative w-20 h-20 border border-red-500"></div> --}}
                {{-- startTimepointHandle --}}
                {{-- <div class="w-[30%] h-[2px] bg-amber-700 border-t-2 border-t-amber-700 absolute right-full">
                <div class="relative flex flex-row justify-center items-center w-[140px] -translate-x-2/4 -translate-y-2/4 -rotate-45 h-10">
                    <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-start">
                        <div class="w-[1px] h-5 translate-x-2/4 translate-y-0 rotate-45 flex justify-end items-center">
                            <pre class="text-amber-200 text-[9px] inline-block">{{ $startingHourpoint }} </pre>
                        </div>
                    </div>
                    <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-start invisible"></div>
                </div>
            </div> --}}
                {{-- endTimepointHandle --}}
                {{-- <div class="w-[30%] h-px bg-amber-700 border-t-2 border-t-amber-700 absolute top-full left-full">
                <div class="relative flex flex-row justify-center items-center w-[140px] -translate-x-2/4 -translate-y-2/4 -rotate-45 h-10 -right-full">
                    <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-end invisible"></div>
                    <div class="bg-amber-700 flex-[auto] h-px flex items-center justify-end">
                        <div class="w-[3px] h-5 translate-x-2/4 translate-y-0 rotate-45 flex justify-start items-center">
                            <pre class="text-amber-200 text-[9px]"> {{ $endingHourpoint }}</pre>
                        </div>
                    </div>
                </div>
            </div> --}}

             @isset($tasksGraphArray)
                    @foreach ($tasksGraphArray as $_task)
                        <div style=" @php print_r("top:". substr(100*abs((abs(substr($startingDatepoint_unix,0,10) -         $_task->starting_time)) / (abs(substr($startingDatepoint_unix,0,10)) - substr($endingDatepoint_unix,0,10))),0,2)    ."%" ) @endphp ;
                                  @php print_r("height:". str_replace(".", "", substr(100*abs( (abs($_task->ending_time - $_task->starting_time))  /  (abs(substr($startingDatepoint_unix,0,10) - substr($endingDatepoint_unix,0,10)))  )  ,0,2 ) ) ."%") @endphp"

                            {{-- The Starting point is 100% off by Y Axis so i added translate transform  --}}

                            class="taskGraphItem box-border -translate-y-full w-full absolute text-[9px] border border-cyan-800">
                            <div class="box-border border border-b-transparent border-r-transparent border-l-transparent border-t-purple-600 h-[20px] w-1/5 absolute -left-[20%]">
                                <div class="flex justify-end">
                                    <div class="mx-1">{{ date('H:i', $_task->starting_time + 12600) }}</div>
                                    <div class="">{{ date('H:i', $_task->ending_time + 12600) }}</div>
                                </div>
                            </div>
                        </div>

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
        $('#flattenTasksGraph').on('click', function() {
            // $('.taskGraphItem').toggleClass('relative');
            $('.taskGraphItem').removeClass('absolute');
            $('.taskGraphItem').addClass('relative');
            $('.taskGraphItem').css("top", "")
            // console.log(kir);
        })
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
