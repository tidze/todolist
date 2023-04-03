<div class="border border-sky-300">
    {{-- Components Debugger Information --}}
    <p class="text-amber-600 text-[8px]">
        {{-- taskCategory= <span class='text-amber-100'>{{ ($taskCategory ?? 'Not Set') }}</span> <br> --}}
        {{-- taskDescription= <span class="text-amber-100">{{ $taskDescription ?? 'Not Set'}}</span><br> --}}
        {{-- desiredDuration= <span class="text-amber-100">{{ $desiredDuration ?? 'Not Set'}}</span><br> --}}
        {{-- startingTimepoint_unix= <span class="text-amber-100">{{ $startingTimepoint_unix ?? 'Not Set'}}</span><br> --}}
        {{-- endingTimepoint_unix= <span class="text-amber-100">{{ $endingTimepoint_unix ?? 'Not Set'}}</span><br> --}}
        {{-- startingTimepoint= <span class="text-amber-100">{{ $startingTimepoint ?? 'Not Set'}}</span><br> --}}
        {{-- endingTimepoint= <span class="text-amber-100">{{ $endingTimepoint ?? 'Not Set'}}</span><br> --}}
        {{-- startingDatepoint= <span class="text-amber-100">{{ $startingDatepoint ?? 'Not set'}}</span><br> --}}
        {{-- endingDatepoint= <span class="text-amber-100">{{ $endingDatepoint ?? 'Not set'}}</span><br> --}}
        {{-- targetTaskIdEdit= <span class="text-amber-100">{{ $targetTaskIdEdit??'Not set' }}</span><br> --}}
        {{-- detector= <span class="text-amber-100">{{ $detector??'Not Set' }}</span><br> --}}
        {{-- _88= <span class="text-amber-100">{{ ($_88??'Not Set') }}</span><br> --}}
        {{-- _99= <span class="text-amber-100">{{ ($_99??'Not Set') }}</span><br> --}}
        {{-- date_default_timezone_get=<span class="text-amber-100">{{ date_default_timezone_get() }}</span><br> --}}
        {{-- timezone= <span class="text-amber-100">{{ ($timezone??'Not Set')}}</span><br> --}}
    </p>
    <input type="hidden" id="targetTaskIdEdit" name="targetTaskIdEdit" wire:model.defer="targetTaskIdEdit" class="w-32 border-2 border-indigo-500" value="{{ $targetTaskIdEdit }}"
        readonly>
    {{-- <label for="targetTaskIdEdit">targetTaskId</label>
    @error('targetTaskIdEdit')
        <span class="text-red-500 text-[9px]">{{ $message }}</span>
    @enderror
    <br>
    @empty($targetTaskIdEdit)
        <p>targetTaskIdEdit is empty</p>
    @else
        <p>targetTaskIdEdit <span class="underline">Not</span> empty</p>
    @endempty
    <br> --}}
    <div id="targetDateContainer">
        <input type="date" id="targetDate" value="{{ $startingDatepoint }}">
        <label for="targetDate" class="text-teal-600">targetDate</label>
    </div>
    <form wire:submit.prevent="storeOrUpdate({{ str_contains($detector, 9) ? $_99 : $_88 }})">
        @csrf
        {{-- startingTimepoint Component --}}
        <div>
            <div id="startingDateContainer" class="inline-block border-2 border-sky-500">
                <input {{-- wire:ignore --}} id="startingDate" type="date" class="" value="{{ $startingDatepoint }}">
            </div>
            <input id="startingTimepoint" wire:model.defer="startingTimepoint" class="time startingTimepoint bg-black text-white text-center w-40" type="text" />
            <label for="startingTimepoint" class="text-teal-600">startingTimepoint</label>
            {{-- <label for="startingTimepoint">d</label> --}}
            <input id="startingTimepoint_unix" wire:model.defer="startingTimepoint_unix" name="startingTimepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]"
                type="hidden" value="" />
            {{-- <lable for="startingTimepoint_unix">startingTimepoint_unix</lable>
            @error('startingTimepoint_unix')
                <span class="text-red-500 text-[9px]">{{ $message }}</span>
            @enderror --}}
        </div>

        {{-- endingTimepoint Component --}}
        <div>
            <div id="endingDateContainer" class="inline-block border-2 border-sky-500">
                <input {{-- wire:ignore --}} id="endingDate" type="date" class="" value="{{ $endingDatepoint }}">
            </div>
            <input id="endingTimepoint" wire:model.defer="endingTimepoint" class="time endingTimepoint bg-black text-white text-center w-40" type="text"
                value={{ $endingTimepoint }} onchange="" />
            <label for="endingTimepoint" class="text-teal-600">endingTimepoint</label>
            <input name="endingTimepoint_unix" wire:model.defer="endingTimepoint_unix" id="endingTimepoint_unix" class="bg-black text-white text-center w-52 p-0 text-[10px]"
                type="hidden" value="0" />
            {{-- <lable for="startingTimepoint_unix">startingTimepoint_unix</lable>
            @error('endingTimepoint_unix')
                <span class="text-red-500 text-[9px]">{{ $message }}</span>
            @enderror --}}
        </div>
        <div>
            <input id="fullDuration_obj" wire:model="fullDuration_obj" class="bg-black text-white text-center w-64 p-0 text-[10px]" type="text" value="sdf" />
            <label for="fullDuration" class="text-teal-600">fullDuration</label>
        </div>
        <div class="inline-block w-52 py-5 mr-9 relative">
            <div class="absolute flex left-full mx-2">
                <label id="rangeValue" class="">
                    @if (empty($desiredDuration))
                        0
                    @else
                        @php print(''.$desiredDuration.'') @endphp
                    @endif
                </label>
                <span class="mx-1">m</span>
            </div>
            <input name="desiredDuration" wire:model.defer="desiredDuration" id="desiredDuration" min="0"
                max=@if (empty($desiredDuration)) 0 @else @php print('\''.$desiredDuration.'\'') @endphp @endif type="range"
                value=@if (empty($desiredDuration)) 0 @else @php print('\''.$desiredDuration.'\'') @endphp @endif
                class="inline-block w-full h-2 bg-gray-700 p-1 rounded-lg appearance-none cursor-pointer range-lg" oninput="rangeValue.innerText = this.value">
        </div>
        <lable for="desiredDuration">desiredDuration</lable>
        @error('desiredDuration')
            <span class="text-red-500 text-[9px]">{{ $message }}</span>
        @enderror
        <div>
            <input id="taskCategory" wire:model.defer="taskCategory" name="taskCategory" type="text" class="bg-black text-white text-center w-64 p-0 text-[10px]">
            <label for="taskCategory">taskCategory</label>
            @error('taskCategory')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <br>
            <input id="taskDescription" wire:model.defer="taskDescription" name="taskDescription" type="text" class="bg-black text-white text-center w-64 p-0 text-[10px]">
            <label for="taskDescription">taskDescription</label>
            @error('taskDescription')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button wire:click="storeOrUpdate({{ $_99 }})"
            class="px-3 py-1 text-xs font-medium mr-2 mb-2 text-gray-900
        focus:outline-none bg-white rounded-lg border border-gray-200
        hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
        focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
        dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
        dark:hover:bg-gray-700">Add
            Task</button>
        <button wire:click="storeOrUpdate({{ $_88 }})"
            class="px-3 py-1 text-xs font-medium mr-2 mb-2 text-gray-900
        focus:outline-none bg-white rounded-lg border border-gray-200
        hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
        focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
        dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
        dark:hover:bg-gray-700">Update
            Task</button>
    </form>
</div>

@push('script')
    <script>
        console.log('Task Script Loaded.')
        const date1 = new Date();

        Livewire.hook('component.initialized', (component) => {
            $('.startingTimepoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('.endingTimepoint').clockTimePicker({
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            setDateForToday("#targetDate");
            copyDate("#targetDate", "#startingDate");
            copyDate("#targetDate", "#endingDate");
            // console.log('component.initialized');
        });

        Livewire.hook('element.updated', (el, component) => {
            $('.startingTimepoint').clockTimePicker({
                autosize: true,
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
            $('.endingTimepoint').clockTimePicker({
                fonts: {
                    fontFamily: 'Rubik'
                }
            });
        });
        // input range wasn't working in chrome so I added   part
        document.querySelectorAll('input[type="range"]').forEach((input) => {
            input.addEventListener('mousedown', () => window.getSelection().removeAllRanges());
        });

        $("#startingTimepoint").on("change", () => {
            giveDateObject("#startingDate", "#startingTimepoint", "#startingTimepoint_unix");
            document.getElementById("startingTimepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingTimepoint").dispatchEvent(new Event('input'));
        });
        $("#endingTimepoint").on("change", () => {
            giveDateObject("#endingDate", "#endingTimepoint", "#endingTimepoint_unix");
            document.getElementById("endingTimepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("endingTimepoint").dispatchEvent(new Event('input'));
            // console.log('endingTimepoint on change');
        });
        $("#desiredDuration").on("change", () => {
            document.getElementById("desiredDuration").dispatchEvent(new Event('input'));
        });

        $("#targetDate").on("change", () => {
            copyDate("#targetDate", "#startingDate");
            copyDate("#targetDate", "#endingDate");
            giveDateObject("#startingDate", "#startingTimepoint", "#startingTimepoint_unix");
            giveDateObject("#endingDate", "#endingTimepoint", "#endingTimepoint_unix");
            document.getElementById("endingTimepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingTimepoint_unix").dispatchEvent(new Event('input'));
            // document.getElementById("targetDate").dispatchEvent(new Event('input'));
            // document.getElementById("startingDate").dispatchEvent(new Event('input'));
            // document.getElementById("endingDate").dispatchEvent(new Event('input'));
        });

        $("#startingDate").on("change", () => {
            giveDateObject("#startingDate", "#startingTimepoint", "#startingTimepoint_unix");
            document.getElementById("startingTimepoint_unix").dispatchEvent(new Event('input'));
            console.log('#startingHourpoint onChange');
        });
        $("#startingDate").on("input", () => {
            console.log('#startingHourpoint onInput');
        });

        $("#endingDate").on("change", () => {
            giveDateObject("#endingDate", "#endingTimepoint", "#endingTimepoint_unix");
            document.getElementById("endingTimepoint_unix").dispatchEvent(new Event('input'));
        });

        // for all input[date], to be selectable with just clicking anywhere on input. (not just date picker icon)
        $("#startingDateContainer").on("click", () => {
            document.querySelector("#startingDate").showPicker();
        });
        $("#endingDateContainer").on("click", () => {
            document.querySelector("#endingDate").showPicker();
        });
        $("#targetDateContainer").on("click", () => {
            document.querySelector("#targetDate").showPicker();
        });

        function giveDateObject(dateInput, input, output) {
            input = String(input);
            output = String(output);

            // getting the day, month, year from targetDate input and creating a date
            let purifiedDate = $(dateInput).val().replaceAll('-', '');
            let year = purifiedDate.slice(0, 4);

            // and do not forget that js month is starting from '0'
            let month = purifiedDate.slice(4, 6) - 1;
            let day = purifiedDate.slice(6, 8);
            let date = new Date(year, month, day);

            // I did not want any milisecond in parameter
            date.setSeconds(0);

            let hours = $(input).val().replace(':', '').slice(0, 2);
            let minutes = $(input).val().replace(':', '').slice(2, 4);
            date.setHours(hours);
            date.setMinutes(minutes);
            $(output).val(date.getTime());
            // document.getElementById(output).value = date;
            setFullDuration();
        }

        function setFullDuration() {
            // console.log("setFullDuration");
            let startingTimePoint = document.getElementById("startingTimepoint_unix").value;
            let endingTimePoint = document.getElementById("endingTimepoint_unix").value;
            let difference = Math.abs(startingTimePoint - endingTimePoint);
            document.getElementById("fullDuration_obj").value = msToTime(difference);
            document.getElementById("desiredDuration").max = msToMin(difference);
            document.getElementById("desiredDuration").value = msToMin(difference);
            document.getElementById("desiredDuration").dispatchEvent(new Event('input'));
            document.getElementById("rangeValue").innerText = msToMin(difference);

        }

        function msToMin(duration) {
            return Math.floor(duration / (1000 * 60));
            // return Math.ceil(duration / (1000 * 60));
        }

        function msToTime(duration) {
            var milliseconds = parseInt((duration % 1000) / 100),
                seconds = Math.floor((duration / 1000) % 60),
                minutes = Math.floor((duration / (1000 * 60)) % 60),
                hours = Math.floor((duration / (1000 * 60 * 60)) % 24),
                day = Math.floor(duration / (1000 * 60 * 60 * 24)),
                hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            return day + " " + hours + ":" + minutes + ":" + seconds + "." + milliseconds;
            // return day + " " + hours + ":" + minutes + ":" + seconds;
        }

        function dateSeperator() {
            // a purified date is a date that has no '-', '/', or any other uselesh shit
            let purifiedDate = $("#date").val().replaceAll('-', '');
            let year = purifiedDate.slice(0, 4);
            let month = purifiedDate.slice(4, 6);
            let day = purifiedDate.slice(6, 8);
            // console.log(day, month, year);
        }

        function setDateForToday(targetInput) {
            let newDate = new Date();
            let day = ("0" + newDate.getDate()).slice(-2);
            let month = ("0" + (newDate.getMonth() + 1)).slice(-2);
            let year = newDate.getFullYear();
            $(targetInput).val(year + '-' + month + '-' + day);
        }

        function copyDate(input, output) {
            $(output).val($(input).val());
        }
    </script>
@endpush
