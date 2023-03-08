<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todolist</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-clock-timepicker.min.js') }}"></script>

</head>

<body class="antialiased font-Rubik">
    @include('layouts.navbar')
    @yield('content')
    @livewireScripts
    @stack('script')

    {{-- <input datepicker datepicker-autohide data-date="02/25/2022" datepicker-format="dd/mm/yyyy" datepicker-buttons type="text"
            class="w-64 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select date"> --}}

    <a href="{{ route('TaskLivewire') }}" class="">TaskLivewire</a>
    <br>
    @livewire('task')
    <br>

    <input type="date" id="targetDate">
    <label for="targetDate">targetDate</label>

    <form action="" method="POST">
        @csrf
        <div>
            <input id="startingDate" type="date" class="">
            <input id="startingTimepoint" class="time startingTimepoint bg-black text-white text-center w-40" type="text" value="10:15" />
            <label for="startingTimepoint">startingTimepoint</label>
            <input name="startingTimepoint_obj" id="startingTimepoint_obj" class="bg-black text-white text-center w-40 p-0 text-[10px]" type="text" value="0" />
        </div>

        <div>
            <input id="endingDate" type="date" class="">
            <input id="endingTimepoint" class="time endingTimepoint bg-black text-white text-center w-40" type="text" value="10:15" onchange="" />
            <label for="endingTimepoint">endingTimepoint</label>
            <input name="endingTimepoint_obj" id="endingTimepoint_obj" class="bg-black text-white text-center w-40 p-0 text-[10px]" type="text" value="0" />
        </div>
        <div>
            <input id="fullDuration_obj" class="bg-black text-white text-center w-64 p-0 text-[10px]" type="text" value="sdf" />
            <label for="fullDuration">fullDuration</label>
        </div>
        <div class="w-52 py-5 relative">
            <div class="absolute flex left-full mx-2">
                <label id="rangeValue" class="">d0</label>
                <span class="mx-1">m</span>
            </div>
            <input name="desiredDuration" id="desiredDuration" min="0" max="10" type="range" value="0"
                class="w-full h-2 bg-gray-700 p-1 rounded-lg appearance-none cursor-pointer range-lg" oninput="rangeValue.innerText = this.value">
        </div>

        <div>
            <input id="taskCategory" name="taskCategory" type="text" class="bg-black text-white text-center w-64 p-0 text-[10px]">
            <label for="taskCategory">taskCategory</label>
            @error('taskCategory')<span class="text-red-500">{{ $message }}</span>@enderror
            <br>
            <input id="taskDescription" name="taskDescription" type="text" class="bg-black text-white text-center w-64 p-0 text-[10px]">
            <label for="taskDescription">taskDescription</label>
            @error('taskDescription')<span class="text-red-500">{{ $message }}</span>@enderror
        </div>
        <button type="submit"
            class="px-3 py-1 text-xs font-medium mr-2 mb-2 text-gray-900
        focus:outline-none bg-white rounded-lg border border-gray-200
        hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
        focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
        dark:text-gray-400 dark:border-gray-600 dark:hover:text-white
        dark:hover:bg-gray-700">Add Task</button>
    </form>

    {{-- all tasks from database into table format --}}
    <div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-1">
                            id
                        </th>
                        <th scope="col" class="px-3 py-1">
                            category_id
                        </th>
                        <th scope="col" class="px-3 py-1">
                            Categories.category
                        </th>
                        <th scope="col" class="px-3 py-1">
                            Categories.description
                        </th>
                        <th scope="col" class="px-3 py-1">
                            duration
                        </th>
                        <th scope="col" class="px-3 py-1">
                            starting_time
                        </th>
                        <th scope="col" class="px-3 py-1">
                            ending_time
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($allTasks as $task)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $task->id }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $task->category_id }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $task->category }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $task->description }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $task->desired_duration }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $task->starting_time }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $task->ending_time }}
                            </td>
                            <td class="px-4 py-2">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>


    @include('layouts.footer')
    <script>
        $(document).ready(function() {
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
            copyDate("#targetDate","#startingDate");
            copyDate("#targetDate","#endingDate");
            });

        $("#startingTimepoint").on("change", () => {
            giveDateObject("#startingDate","#startingTimepoint", "#startingTimepoint_obj");
        });
        $("#endingTimepoint").on("change", () => {
            giveDateObject("#endingDate","#endingTimepoint", "#endingTimepoint_obj");
        });

        $("#targetDate").on("change", () => {
            copyDate("#targetDate","#startingDate");
            copyDate("#targetDate","#endingDate");
        });

        function giveDateObject(dateInput, input, output) {
            input = String(input);
            output = String(output);

            // getting the day, month, year from targetDate input and creating a date
            let purifiedDate = $(dateInput).val().replaceAll('-', '');;
            let year = purifiedDate.slice(0, 4);

            // and do not forget that js month is starting from '0'
            let month = purifiedDate.slice(4, 6) -1;
            let day = purifiedDate.slice(6, 8);
            let date = new Date(year, month, day);

            // I did not want any milisecond in parameter
            date.setSeconds(0);

            let hours = $(input).val().replace(':', '').slice(0, 2);
            let minutes = $(input).val().replace(':', '').slice(2, 4);
            date.setHours(hours);
            date.setMinutes(minutes);
            // date.toJSON();
            $(output).val(date);
            setFullDuration();
        }

        function setFullDuration() {
            console.log("setFullDuration");
            let startingTimePoint = new Date(document.getElementById("startingTimepoint_obj").value);
            let endingTimePoint = new Date(document.getElementById("endingTimepoint_obj").value);
            let difference = Math.abs(startingTimePoint - endingTimePoint);
            document.getElementById("fullDuration_obj").value = msToTime(difference);
            document.getElementById("desiredDuration").max = msToMin(difference);
            document.getElementById("desiredDuration").value = msToMin(difference);
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
            console.log(day, month, year);
        }

        function setDateForToday(targetInput) {
            let newDate = new Date();
            let day = ("0" + newDate.getDate()).slice(-2);
            let month = ("0" + (newDate.getMonth()+ 1)).slice(-2);
            let year = newDate.getFullYear();
            $(targetInput).val(year+'-'+month+'-'+day);
        }

        function copyDate(input,output){
            $(output).val($(input).val());
        }


    </script>
</body>

</html>
