<div class="relative border-4 border-white text-white p-1 pb-0 flex-1" >
    <div wire:loading class="bg-blue-400 bg-opacity-30 animate-pulse absolute w-full h-full z-0 -m-1"></div>

    <div class="relative z-50">

        {{-- Components Debugger Information --}}
        <p class="text-amber-600 text-[12px]">
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
            {{-- category_distinct_desc= <span class="text-amber-100">{{ print_r($category_distinct_desc)??'Not set' }}</span><br> --}}
            {{-- category_description_distinct_desc= <span class="text-amber-100">{{ print_r($category_description_distinct_desc)??'Not set' }}</span><br> --}}
            {{-- sortedCategoriesByCategory= <pre class="text-amber-100">{{ print_r($sortedCategoriesByCategory)??'Not set' }}</pre><br> --}}
            {{-- taskDone= <span class="text-amber-100">{{ $taskDone ?? 'Not     set' }}</span><br> --}}
            {{-- detector= <span class="text-amber-100">{{ $detector??'Not Set' }}</span><br> --}}
            {{-- date_default_timezone_get=<span class="text-amber-100">{{ date_default_timezone_get() }}</span><br> --}}
            {{-- timezone= <span class="text-amber-100">{{ ($timezone??'Not Set')}}</span><br> --}}
            {{-- @if ($errors->any()) --}}
            {{-- <div class="alert alert-danger"> --}}
            {{-- <ul> --}}
            {{-- @foreach ($errors->all() as $error) --}}
            {{-- <li>{{ $error }}</li> --}}
            {{-- @endforeach --}}
            {{-- </ul> --}}
            {{-- </div> --}}
            {{-- @endif --}}
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
        <div class="flex items-center justify-center">
            <div id="targetDateContainer" class="flex items-center justify-center p-1">
                <input type="date" id="targetDate" class="inline-flex border-2 rounded-xl border-gray-500 bg-gray-800" value="{{ $startingDatepoint }}">
                <label for="targetDate" class="px-1">Date</label>
            </div>
            {{-- Now Button With Java Fking Script --}}
            <div class="flex justify-center items-center">
                <div id="setNowTime"
                    class="text-[14px] text-gray-400 bg-gray-800 inline-flex justify-center items-center border-2 border-gray-500 rounded-xl px-2 py-2 hover:bg-gray-700 cursor-pointer active:border-gray-50 active:text-white select-none">
                    Now
                </div>
                <div id="switchHours"
                    class="text-[14px] text-gray-400 bg-gray-800 inline-flex justify-center items-center border-2 border-gray-500 rounded-xl px-2 py-2 hover:bg-gray-700 cursor-pointer active:border-gray-50 active:text-white select-none">
                    Switch
                </div>
            </div>
        </div>
        {{-- Old FOrm --}}
        <div class="">
            <div class="flex flex-col flex-grow">

                {{-- Component startingTimepoint --}}
                <div class="flex">
                    {{-- for input date overlay to be clickable every where --}}
                    <div id="startingDateContainer" class="basis-2/5 inline-block border rounded-xl border-transparent">
                        <input {{-- wire:ignore --}} id="startingDate" type="date" class="border-2 rounded-xl border-gray-500 bg-gray-800" value="{{ $startingDatepoint }}">
                    </div>
                    <div class="basis-2/5 flex">
                        <input class="inline-block w-40 bg-black text-center startingTimepoint border-2 h-full rounded-xl border-gray-500" id="startingTimepoint" wire:model.defer="startingTimepoint" type="text"
                            value="{{$startingTimepoint}}" />
                    </div>
                    <div id="setNowTimeForStartingHourAndMinute"
                    class="text-[14px] text-gray-400 bg-gray-800 inline-flex justify-center items-center border-2 border-gray-500 rounded-xl px-2 py-2 hover:bg-gray-700 cursor-pointer active:border-gray-50 active:text-white select-none">
                    Now
                    </div>
                    <label class="basis-1/5 self-center" for="startingTimepoint">Start</label>

                    <input class="bg-black text-center p-0 text-[15px]" id="startingTimepoint_unix" wire:model.defer="startingTimepoint_unix" name="startingTimepoint_unix" type="hidden" value="" />
                    {{-- <label for="starting/Timepoint_unix">startingTimepoint_unix</label> --}}
                    {{-- @error('startingTimepoint_unix') --}}
                    {{-- <span class="text-red-500 text-[9px]">{{ $message }}</span> --}}
                    {{-- @enderror --}}
                </div>

                {{-- Component endingTimepoint --}}
                <div class="flex">
                    <div id="endingDateContainer" class="basis-2/5 inline-block border rounded-xl border-transparent">
                        <input {{-- wire:ignore --}} id="endingDate" type="date" class="border-2 rounded-xl border-gray-500 bg-gray-800" value="{{ $endingDatepoint }}">
                    </div>
                    <div class="basis-2/5 flex">
                        <input class="w-40 bg-black text-center endingTimepoint border-2 h-full rounded-xl border-gray-500" id="endingTimepoint" wire:model.defer="endingTimepoint" type="text"
                            value={{ $endingTimepoint }} onchange="" />
                    </div>
                    <div id="setNowTimeForEndingHourAndMinute"
                    class="text-[14px] text-gray-400 bg-gray-800 inline-flex justify-center items-center border-2 border-gray-500 rounded-xl px-2 py-2 hover:bg-gray-700 cursor-pointer active:border-gray-50 active:text-white select-none">
                    Now
                    </div>
                    <label class="basis-1/5 self-center" for="endingTimepoint">End</label>

                    <input name="endingTimepoint_unix" wire:model.defer="endingTimepoint_unix" id="endingTimepoint_unix" class="bg-black text-center p-0 text-[15px]" type="hidden" value="0" />
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
                            max=@if (empty($desiredDuration)) 0 @else @php print('\''.$desiredDuration.'\'') @endphp @endif type="range" readonly disabled
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
                        {{-- @foreach ($category_distinct_desc as $category) --}}
                            {{-- <div class="py-1 px-2 border border-l-4 border-white text-white cursor-pointer rounded-lg mr-1 select-none whitespace-nowrap categoryAutoSetter" style="">{{ $category->category }} --}}
                            {{-- </div> --}}
                        {{-- @endforeach --}}

                        @for ($i = 0; $i < count($sortedCategoriesByCategory_ArrayKeys); $i++)
                            <div class="py-1 px-2 border border-l-4 border-white text-white cursor-pointer rounded-lg mr-1 select-none whitespace-nowrap categoryAutoSetter" style="">{{$sortedCategoriesByCategory_ArrayKeys[$i]}}</div>
                        @endfor
                    </div>

                    @error('taskCategory')
                        <div class="flex-auto w-full text-center">
                            <div class="text-red-500 text-[10px]">{{ $message }}</div>
                        </div>
                    @enderror
                    <div class="flex flex-auto justify-center items-center text-center py-1">
                        <input id="taskDescription" wire:model.defer="taskDescription" name="taskDescription" type="text"
                            class="rounded-xl text-lg inline-block flex-auto bg-black first-letter:bg-black text-center text-[9px] py-2">
                        <label class="flex-auto" for="taskDescription">Description</label>
                    </div>

                    {{-- Component `Select Description` --}}
                    <div class="flex w-full overflow-auto pb-2 descriptionAutoSetterContainer">
                        @foreach ($categories as $category)
                            {{-- @foreach ($tasksOfTheCategory as $task) --}}
                                <div class="py-1 px-2 border border-l-4 border-l-transparent cursor-pointer rounded-lg mr-1 select-none whitespace-nowrap descriptionAutoSetter"
                                    style="border-color:{{ $category['color'] }};color:{{ $category['color'] }}">
                                    {{ $category['description'] }}</div>
                            {{-- @endforeach --}}
                        @endforeach
                    </div>
                    @error('taskDescription')
                        <div class="flex-auto w-full text-center">
                            <div class="text-red-500 text-[10px]">{{ $message }}</div>
                        </div>
                    @enderror

                    {{-- Component `Select Done/UnDone` --}}
                    <div
                        class="m-1
                mb-2
                border border-gray-500
                {{-- px-2 --}}
                {{-- py-2 --}}
                flex
                flex-row
                justify-center
                items-center
                text-sm
                font-medium
                rounded-xl
                text-gray-400
                border-gray-600
                bg-gray-800
                hover:text-white
                hover:bg-gray-700
                cursor-pointer
                {{-- ring-4 --}}
                {{-- ring-red-500 --}}
                {{-- focus:ring-4 --}}
                {{-- focus:ring-opacity-100 --}}
                {{-- focus:ring-gray-700 --}}
                {{-- focus:z-10 --}}
                ">
                        <label for="taskDone" class="inline-flex cursor-pointer w-full justify-center items-center px-1 py-2 select-none ring-4 ring-transparent active:ring-gray-600 border-transparent rounded-xl">
                            taskDone
                            <input type="checkbox" name="taskDone" id="taskDone" wire:model.defer="taskDone"
                                class="
                        cursor-pointer
                        inline-flex
                        px-2
                        py-2
                        mx-2
                        text-sm
                        font-medium
                        focus:outline-none
                        border
                        rounded-xl
                        focus:z-10
                        {{-- focus:ring-4 --}}
                        {{-- focus:ring-gray-200 --}}
                        focus:ring-gray-700
                        bg-gray-800
                        text-gray-400
                        border-gray-600
                        {{-- hover:text-white --}}
                        hover:bg-gray-700
                    " />
                        </label>

                    </div>

                </div>
                <div class="flex">
                    <button wire:click="store"
                        class="flex-1
                        px-3
                        py-3
                        m-1
                        text-sm
                        font-medium
                      text-gray-900
                        focus:outline-none
                        bg-white border
                        border-gray-200
                        rounded-xl
                        hover:bg-gray-100
                        hover:text-blue-700
                        focus:z-10
                        focus:ring-4
                        focus:ring-gray-200
                        dark:focus:ring-gray-700
                        dark:bg-gray-800
                        dark:text-gray-400
                        dark:border-gray-600
                        dark:hover:text-white
                        dark:hover:bg-gray-700">Add
                        Task</button>
                    <button wire:click="update"
                        class="flex-1 px-3 py-3 m-1 text-sm font-medium text-gray-900
                          focus:outline-none bg-white border border-gray-200 rounded-xl
                        hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
                        focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
                        dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
                        dark:hover:bg-gray-700">Update
                        Task</button>
                </div>

                {{-- Loading State Animations --}}
                {{-- <div class="flex flex-col pt-1"> --}}
                {{-- <div class="p-0 mb-1" wire:loading wire:target="update"> --}}
                {{-- <div class="text-blue-400 i nline-block border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Updating The Task ...</div> --}}
                {{-- </div> --}}
                {{-- <div class="p-0 mb-1" wire:loading wire:target="store"> --}}
                {{-- <div class="text-blue-400 i nline-block border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Adding The Task ...</div> --}}
                {{-- </div> --}}
                {{-- <div class="p-0 mb-1" wire:loading> --}}
                {{-- <div class="text-blue-400 i nline-block border-blue-700 border-l-8 p-2 bg-blue-400 bg-opacity-30 animate-pulse">Re-Rendering ...</div> --}}
                {{-- </div> --}}
                <div>
                    @if (session()->has('store_validator_fail'))
                        <div class="bg-yellow-500 bg-opacity-50 border-l-8 border-yellow-600 text-yellow-500 p-2 mb-1">
                            {{ session('store_validator_fail') }} <div class="text-yellow-500 inline-flex justify-center items-center border-2 border-yellow-500 rounded-full w-5 h-5 mx-1"><b>!</b></div>
                        </div>
                    @endif
                    @if (session()->has('update_validator_fail'))
                        <div class="bg-yellow-500 bg-opacity-50 border-l-8 border-yellow-600 text-yellow-500 p-2 mb-1">
                            {{ session('update_validator_fail') }} <div class="text-yellow-500 inline-flex justify-center items-center border-2 border-yellow-500 rounded-full w-5 h-5 mx-1"><b>!</b></div>
                        </div>
                    @endif
                    @if (session()->has('successfull_message'))
                        <div class="bg-green-500 bg-opacity-50 border-l-8 border-green-600 text-green-500 p-2 mb-1">
                            {{ session('successfull_message') }} <span class="text-green-500">&#10003</span>
                        </div>
                    @endif
                    @if (session()->has('unsuccessfull_message'))
                        <div class="bg-red-500 bg-opacity-50 border-l-8 border-red-700 border-opacity-90 text-red-600 text-opacity-80 p-2 mb-1">
                            {{ session('unsuccessfull_message') }} <span class="text-red-600">&#10005</span>
                        </div>
                    @endif
                </div>
                {{-- </div> --}}
                {{-- Loading State Animations END --}}
            </div>

        </div>

    </div>
</div>

@push('script')
    <script>
        // console.log('Task\'s Script Loaded.')
        // The variables for category on click, shows each description for that specific category
        let sortedCategoriesByCategory_ENCODED = @json($sortedCategoriesByCategory_ENCODED);
        var sortedCategoriesByCategory_ENCODED_Parsed = (JSON.parse(sortedCategoriesByCategory_ENCODED));

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

        // Onclick event
        $(document).ready(function() {

        });

        function isJSON(str) {
            try {
                JSON.parse(str);
                return true;
            } catch (e) {
                return false;
            }
        }

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
        // input range wasn't working in chrome so I added this part
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

        $('#switchHours').on('click',()=>{
            let $startingTimepoint =  $('#startingTimepoint').val();
            $('#startingTimepoint').val($('#endingTimepoint').val());
            $('#endingTimepoint').val($startingTimepoint);

            let $startingTimepoint_unix =  $('#startingTimepoint_unix').val();
            $('#startingTimepoint_unix').val($('#endingTimepoint_unix').val());
            $('#endingTimepoint_unix').val($startingTimepoint_unix);

            document.getElementById("endingTimepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingTimepoint_unix").dispatchEvent(new Event('input'));
        });

        /*
        * Creates a new date from given date(dateInput param) and hour(input param) input and puts it in output(output param).
        * Parameters: dateInput - input[type=date] 2023-06-09
        *             input     - input[type=text] 02:00
        *             output    - input[type=text] 1654889000 unix
        */
        function giveDateObject(dateInput, input, output) {
            input = String(input);
            output = String(output);

            // Getting the day, month, year from targetDate input and creating a date
            let purifiedDate = $(dateInput).val().replaceAll('-', '');  // 2023-06-09 => 20230609
            let year = purifiedDate.slice(0, 4); // 20230609 => 2023

            // And do not forget that js month is starting from '0'
            let month = purifiedDate.slice(4, 6) - 1; // 20230609 => 06 - 1 = 5
            let day = purifiedDate.slice(6, 8); // 20230609 => 09

            // Creates a new date from seperated parameters.(year, month, day)
            let date = new Date(year, month, day);

            // And no miliseconds in parameter :)
            date.setSeconds(0);

            // Gets hours and minutes from given input and uses them to set the new date's hours and minutes.
            let hours = $(input).val().replace(':', '').slice(0, 2); // 02:14 => 0214 => 02
            let minutes = $(input).val().replace(':', '').slice(2, 4); // 02:14 => 0214 => 14
            date.setHours(hours);
            date.setMinutes(minutes);

            let unixTenDigits = date.getTime().toString();
            $(output).val(unixTenDigits.slice(0, 10));

            setFullDuration();
        }

        function setFullDuration() {
            // console.log("setFullDuration");
            let startingTimePoint = document.getElementById("startingTimepoint_unix").value;
            let endingTimePoint = document.getElementById("endingTimepoint_unix").value;
            let difference = Math.abs(startingTimePoint - endingTimePoint);
            document.getElementById("fullDuration_obj").value = secToTime(difference);
            document.getElementById("desiredDuration").max = secToMin(difference);
            document.getElementById("desiredDuration").value = secToMin(difference);
            document.getElementById("desiredDuration").dispatchEvent(new Event('input'));
            document.getElementById("rangeValue").innerText = secToMin(difference);

        }

        function msToMin(duration) {
            return Math.floor(duration / (1000 * 60));
            // return Math.ceil(duration / (1000 * 60));
        }

        function secToMin(duration) {
            return Math.floor(duration / (60));
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

        function secToTime(duration) {
            var milliseconds = parseInt((duration % 1) / 100),
                seconds = Math.floor((duration / 1) % 60),
                minutes = Math.floor((duration / (1 * 60)) % 60),
                hours = Math.floor((duration / (1 * 60 * 60)) % 24),
                day = Math.floor(duration / (1 * 60 * 60 * 24)),
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

        /*
        * Sets date for today. format: 2023-06-04
        * Parameters: targetInput - input[type=date]
        */
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
            $('#taskCategory').val($(this).text().trim());
            let arr = sortedCategoriesByCategory_ENCODED_Parsed[$(this).text().trim()];

            $(".descriptionAutoSetterContainer").html('');
            $.each(arr, function(index, value) {
                $(".descriptionAutoSetterContainer").append('<div class="py-1 px-2 border border-l-4 border-l-transparent cursor-pointer rounded-lg mr-1 select-none whitespace-nowrap descriptionAutoSetter" style="border-color: ' + value.color + '; color: ' + value.color + ';">' + value.description + '</div>');
            });
            $('.descriptionAutoSetter').on('click', function() {
                $('#taskDescription').val($(this).text().trim());
                    document.getElementById("taskDescription").dispatchEvent(new Event('input'));
            });
            document.getElementById("taskCategory").dispatchEvent(new Event('input'));

        });
        $('.descriptionAutoSetter').on('click', function() {
            $('#taskDescription').val($(this).text().trim());
            document.getElementById("taskDescription").dispatchEvent(new Event('input'));
        });

        $('#setNowTime').on('click', function() {
            let newDate = new Date();
            newDate.setSeconds(0);
            $('#startingTimepoint').val(("0" + newDate.getHours()).slice(-2) + ":" + ("0" + newDate.getMinutes()).slice(-2));
            $('#endingTimepoint').val(("0" + newDate.getHours()).slice(-2) + ":" + ("0" + newDate.getMinutes()).slice(-2));
            $('#startingTimepoint_unix').val((newDate.getTime()).toString().substring(0, 10));
            $('#endingTimepoint_unix').val((newDate.getTime()).toString().substring(0, 10));
            document.getElementById("endingTimepoint_unix").dispatchEvent(new Event('input'));
            document.getElementById("startingTimepoint_unix").dispatchEvent(new Event('input'));
            setFullDuration();
        });

        $('#setNowTimeForStartingHourAndMinute').on('click', function() {
            let newDate = new Date();
            newDate.setSeconds(0);
            $('#startingTimepoint').val(("0" + newDate.getHours()).slice(-2) + ":" + ("0" + newDate.getMinutes()).slice(-2));
            $('#startingTimepoint_unix').val((newDate.getTime()).toString().substring(0, 10));
            document.getElementById("startingTimepoint_unix").dispatchEvent(new Event('input'));
            setFullDuration();
        });

        $('#setNowTimeForEndingHourAndMinute').on('click', function() {
            let newDate = new Date();
            newDate.setSeconds(0);
            $('#endingTimepoint').val(("0" + newDate.getHours()).slice(-2) + ":" + ("0" + newDate.getMinutes()).slice(-2));
            $('#endingTimepoint_unix').val((newDate.getTime()).toString().substring(0, 10));
            document.getElementById("endingTimepoint_unix").dispatchEvent(new Event('input'));
            setFullDuration();
        });


    </script>
@endpush
