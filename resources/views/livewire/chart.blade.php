<p class="text-amber-600 text-[9px]">
    {{-- {{ '$startingDatepoint < x_unix' . $startingDatepoint }} --}}
    {{-- {{ '$endingDatepoint > x_unix' . $endingDatepoint }} --}}
    {{-- <div class="bg-slate-700 text-red-50 h-screen w-full"> --}}
    <!--Div that will hold the pie chart-->
    {{-- <div id="chart_div"></div> --}}
    {{-- </div> --}}
</p>
{{-- results from limit --}}
<p class="text-amber-400 text-[10px]">
    results
{{-- <form wire:click="getTasks" class="font-sans"> --}}
    {{-- </form> --}}
    <br>
    {{-- {{ $results }} --}}
</p>
<span wire:click="increment" >getTasks</span>
<span>{{ $count }}</span>

<div>
    {{-- for input date overlay to be clickable every where --}}
    <div id="startingDateContainer" class="inline-block border-2 border-sky-500">
        <input id="startingDate" type="date" class="">
    </div>
    <input id="startingDatepoint" wire:model.defer="startingDatepoint" class="time startingDatepoint bg-black text-white text-center w-40" type="text"
        value='' onchange="" />
    <label for="startingDatepoint" class="text-teal-600">startingDatepoint</label>
    <input name="startingDatepoint_unix" wire:model.defer="startingDatepoint_unix" id="startingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]"
        type="text" value="0" />
    <lable for="startingDatepoint_unix">startingDatepoint_unix</lable>
    @error('startingDatepoint_unix')
        <span class="text-red-500 text-[9px]">{{ $message }}</span>
    @enderror
</div>
<div>
    {{-- for input date overlay to be clickable every where --}}
    <div id="endingDateContainer" class="inline-block border-2 border-sky-500">
        <input id="endingDate" type="date" class="">
    </div>
    <input id="endingDatepoint" wire:model.defer="endingDatepoint" class="time endingDatepoint bg-black text-white text-center w-40" type="text" value=''
        onchange="" />
    <label for="endingDatepoint" class="text-teal-600">endingDatepoint</label>
    <input name="endingDatepoint_unix" wire:model.defer="endingDatepoint_unix" id="endingDatepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]" type="text"
        value="0" />
    <lable for="endingDatepoint_unix">endingDatepoint_unix</lable>
    @error('endingDatepoint_unix')
        <span class="text-red-500 text-[9px]">{{ $message }}</span>
    @enderror
</div>

@push('script')
    <script>
        Livewire.hook('component.initialized', (component) => {
            $('.startingDatepoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('.endingDatepoint').clockTimePicker({
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

        $('#getTasks').on('click', function() {
            console.log('getTasks');
        });


    </script>
@endpush
