<div class="border border-sky-300 flex flex-col text-white p-1">
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
    <input type="hidden" id="targetTaskIdEdit" name="targetTaskIdEdit" wire:model.defer="targetTaskIdEdit" class="w-32 border-2 border-indigo-500" value="{{ $targetTaskIdEdit }}" readonly>
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
    <div id="targetDateContainer" class="flex items-center justify-center p-2">
        <input type="date" id="targetDate" class="inline-block border-2 rounded-xl border-gray-500 bg-gray-800" value="{{ $startingDatepoint }}">
        <label for="targetDate" class="px-1">Date</label>
    </div>
    <form wire:submit.prevent="storeOrUpdate({{ str_contains($detector, 9) ? $_99 : $_88 }})">
        @csrf
        <div class="flex flex-col flex-grow">

            {{-- Component startingTimepoint --}}
            <div class="flex flex-row">
                <div id="startingDateContainer" class="basis-2/5 inline-block border rounded-xl border-transparent">
                    <input {{-- wire:ignore --}} id="startingDate" type="date" class="border-2 rounded-xl border-gray-500 bg-gray-800" value="{{ $startingDatepoint }}">
                </div>
                <div class="basis-2/5 flex">
                    <input class=" inline-block w-40 bg-black text-center startingTimepoint border-2 h-full rounded-xl border-gray-500" id="startingTimepoint" wire:model.defer="startingTimepoint" type="text" />
                </div>
                <label class="basis-1/5 self-center" for="startingTimepoint">Start</label>

                <input class="bg-black text-center text-[8px] " id="startingTimepoint_unix" wire:model.defer="startingTimepoint_unix" name="startingTimepoint_unix" type="hidden" value="" />
                {{-- <label for="startingTimepoint_unix">startingTimepoint_unix</label> --}}
                {{-- @error('startingTimepoint_unix') --}}
                {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
                {{-- @enderror --}}
            </div>

            {{-- Component endingTimepoint --}}
            <div class="flex justify-row" >
                <div id="endingDateContainer" class="basis-2/5 inline-block border-2 rounded-xl border-transparent">
                    <input {{-- wire:ignore --}} id="endingDate" type="date" class="border-2 rounded-xl border-gray-500 bg-gray-800" value="{{ $endingDatepoint }}">
                </div>
                <div class="basis-2/5 flex">
                    <input class="w-40 bg-black text-center endingTimepoint border-2 h-full rounded-xl border-gray-500" id="endingTimepoint" wire:model.defer="endingTimepoint" type="text" value={{ $endingTimepoint }}
                    onchange="" />
                </div>
                <label class="basis-1/5 self-center" for="endingTimepoint">End</label>

                <input name="endingTimepoint_unix" wire:model.defer="endingTimepoint_unix" id="endingTimepoint_unix" class="bg-black text-center w-52 p-0 text-[10px]" type="hidden" value="0" />
                {{-- <label for="startingTimepoint_unix">startingTimepoint_unix</label> --}}
                {{-- @error('endingTimepoint_unix') --}}
                {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
                {{-- @enderror --}}
            </div>
            {{-- Component `Full Duration` --}}
            <div class="flex py-2">
                <input class="flex-1 bg-black text-center p-0 text-[16px] rounded-md" id="fullDuration_obj" wire:model="fullDuration_obj" type="text" value="sdf" readonly />
                <label class="px-2 py-1 text-[16px]" for="fullDuration">Full Duration</label>
            </div>
            {{-- Component `Desired Duration input range` --}}
            <div class="flex flex-col py-2 px-1">
                <div class="flex flex-row">
                    <input class="flex-grow flex-shrink basis-60" name="desiredDuration" wire:model.defer="desiredDuration" id="desiredDuration" min="0"
                        max=@if (empty($desiredDuration)) 0 @else @php print('\''.$desiredDuration.'\'') @endphp @endif type="range"
                        value=@if (empty($desiredDuration)) 0 @else @php print('\''.$desiredDuration.'\'') @endphp @endif oninput="rangeValue.innerText = this.value">
                    <label class="flex-grow flex-shrink basis-1 text-center" id="rangeValue">
                        @if (empty($desiredDuration))
                            0
                        @else
                            @php print(''.$desiredDuration.'') @endphp
                        @endif
                    </label>
                    <div class="flex-shrink">m</div>
                </div>
                <label for="desiredDuration" class="text-center">Desired Duration</label>
                @error('desiredDuration')
                    <span class="text-red-500 text-[9px] text-center">{{ $message }}</span>
                @enderror

            </div>
            <div class="flex-auto w-full">
                <div class="flex flex-auto justify-center items-center text-center py-1">
                    <input id="taskCategory" wire:model.defer="taskCategory" name="taskCategory" type="text"
                        class="rounded-xl text-lg inline-block flex-auto bg-black first-letter:bg-black text-center text-[9px] py-2">
                    <label class="flex-auto" for="taskCategory">Category</label>
                </div>

                {{-- Component `Select Category` --}}
                <div class="flex w-full overflow-auto pb-2">
                    @foreach ($category_Distinct as $category)
                        <div class="py-1 px-2 border border-l-4 border-white text-white cursor-pointer rounded-lg mr-1 select-none whitespace-nowrap categoryAutoSetter" style="">{{ $category->category }}
                        </div>
                    @endforeach
                </div>

                <div class="flex-auto w-full text-center">
                    @error('taskCategory')
                        <div class="text-red-500 text-[10px]">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-auto justify-center items-center text-center py-1">
                    <input id="taskDescription" wire:model.defer="taskDescription" name="taskDescription" type="text"
                        class="rounded-xl text-lg inline-block flex-auto bg-black first-letter:bg-black text-center text-[9px] py-2">
                    <label class="flex-auto" for="taskDescription">Description</label>
                </div>

                {{-- Component `Select Description` --}}
                <div class="flex w-full overflow-auto pb-2">
                    @foreach ($allCategories as $category)
                        <div class="py-1 px-2 border border-l-4 border-l-transparent cursor-pointer rounded-lg mr-1 select-none whitespace-nowrap descriptionAutoSetter"
                            style="border-color:{{ $category->color }};color:{{ $category->color }}">
                            {{ $category->description }}</div>
                    @endforeach
                </div>
                <div class="flex-auto w-full text-center">
                    @error('taskDescription')
                        <div class="text-red-500 text-[10px]">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="flex my-2">
                <button wire:click="storeOrUpdate({{ $_99 }})"
                    class="flex-1 px-3 py-3 m-1 text-sm font-medium text-gray-900
                          focus:outline-none bg-white border border-gray-200 rounded-xl
                        hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
                        focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
                        dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
                        dark:hover:bg-gray-700">Add
                    Task</button>
                <button wire:click="storeOrUpdate({{ $_88 }})"
                    class="flex-1 px-3 py-3 m-1 text-sm font-medium text-gray-900
                          focus:outline-none bg-white border border-gray-200 rounded-xl
                        hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
                        focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
                        dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
                        dark:hover:bg-gray-700">Update
                    Task</button>
            </div>
            <div>
                @if (session()->has('successfull_message'))
                    <div class="text-green-500">
                        {{ session('successfull_message') }}
                    </div>
                @endif
                @if (session()->has('unsuccessfull_message'))
                    <div class="text-red-500">
                        {{ session('unsuccessfull_message') }}
                    </div>
                @endif
            </div>
        </div>

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

        $('.categoryAutoSetter').on('click', function() {
            console.log();
            $('#taskCategory').val($(this).text().trim());
            document.getElementById("taskCategory").dispatchEvent(new Event('input'));
        });
        $('.descriptionAutoSetter').on('click', function() {
            console.log();
            $('#taskDescription').val($(this).text().trim());
            document.getElementById("taskDescription").dispatchEvent(new Event('input'));
        });
    </script>
@endpush
