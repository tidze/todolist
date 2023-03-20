<div class="text-amber-400 text-[10px]">
    <span wire:click="getTask()" class=" border border-amber-600 p-1 rounded hover:bg-yellow-500 hover:text-black cursor-pointer">getTask()</span>
    <br>
    <br>
    {{ '$startingDatepoint < x_unix ' . (isset($startingDatepoint_unix) ? $startingDatepoint_unix : 'Not Set') }}
    <br>
    {{ '$endingDatepoint > x_unix ' . (isset($endingDatepoint_unix) ? $endingDatepoint_unix : 'Not Set') }}
    <div>
        {{-- for input date overlay to be clickable every where --}}
        <div id="startingDateContainer" class="inline-block border-2 border-sky-500">
            <input class="startingDate" type="date" class="">
        </div>
        <input id="startingDatepoint" wire:model.defer="startingDatepoint" class="time startingDatepoint bg-black text-white text-center w-40" type="text" value="00:00"/>
        <label for="startingDatepoint" class="text-teal-600">startingDatepoint</label>
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
            <input class="endingDate" type="date" class="">
        </div>
        <input id="endingDatepoint" wire:model.defer="endingDatepoint" class="time endingDatepoint bg-black text-white text-center w-40" type="text" value='00:00' />
        <label for="endingDatepoint" class="text-teal-600">endingDatepoint</label>
        <input name="endingDatepoint_unix" wire:model="endingDatepoint_unix" id="endingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]"
            type="text" value="0" />
        <lable for="endingDatepoint_unix">endingDatepoint_unix</lable>
        @error('endingDatepoint_unix')
            <span class="text-red-500 text-[9px]">{{ $message }}</span>
        @enderror
    </div>
</div>

@push('script')
    <script>
        console.log('CustomChart Script Loaded.')
        Livewire.hook('component.initialized', (component) => {
            $('.startingDatepoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('.endingDatepoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });

        Livewire.hook('element.updated', (el, component) => {
            $('.startingDatepoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('.endingDatepoint').clockTimePicker({
                autosize: true,
                onModeSwitch: function(MINUTE) {},
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });
        $("#startingDatepoint").on("change", () => {
            giveDateObject("#startingDate", "#startingDatepoint", "#startingDatepoint_unix");
            document.getElementById("startingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingDatepoint").dispatchEvent(new Event('input'));
        });
        $("#endingDatepoint").on("change", () => {
            giveDateObject("#endingDate", "#endingDatepoint", "#endingDatepoint_unix");
            document.getElementById("endingDatepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("endingDatepoint").dispatchEvent(new Event('input'));
            // console.log('endingDatepoint on change');
        });

        // $('#getTasks').on('click', function() {
        //     console.log('getTasks');
        // });

        $(".startingDate").on("change", () => {
            giveDateObject(".startingDate", "#startingDatepoint", "#startingDatepoint_unix");
        });

        $(".endingDate").on("change", () => {
            giveDateObject(".endingDate", "#endingDatepoint", "#endingDatepoint_unix");
        });

    </script>
@endpush
