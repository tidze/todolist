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

    @livewire('task')

    <br>
    {{-- all tasks from database into table format --}}
    @livewire('tasks-table')

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
