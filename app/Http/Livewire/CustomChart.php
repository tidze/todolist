<?php

namespace App\Http\Livewire;

use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CustomChart extends Component
{
    // 1681892041 ▼
    public $c_startingDatepoint_unix;
    public $c_endingDatepoint_unix;
    // 2023-04-19 ▼
    public $c_startingDate;
    public $c_endingDate;
    // 00:00 ▼
    public $c_startingHourpoint;
    public $c_endingHourpoint;

    public $c_tasksGraphArray;
    public $c_flattened;

    public $is_date_different;

    public function mount()
    {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('asia/tehran'));
        $date->setTime(9, 30, 0);
        $this->c_startingDatepoint_unix = $date->format('U');
        $this->c_startingHourpoint = $date->format('H:i');
        $this->c_startingDate = $date->format('Y-m-d');

        $date->add(new DateInterval('P1D'));
        $date->setTime(03, 00, 0);
        $this->c_endingDatepoint_unix = $date->format('U');
        $this->c_endingHourpoint = $date->format('H:i');
        $this->c_endingDate = $date->format('Y-m-d');

        $this->c_flattened = false;
    }

    public function render()
    {
        // $this->getTimeAndDate();
        return view('livewire.custom-chart');
    }

    public function flattenTasksGraph()
    {
        if (isset($this->c_tasksGraphArray)) {
            if ($this->c_flattened) {
                $this->calcTaskTopOffset();

                $this->setTaskPositionType();
                $this->setTaskTranslateType();
            } else {
                $this->setTopOffsetToZero();

                $this->setTaskPositionType();
                $this->setTaskTranslateType();
            }
            $this->toggleFlattened();
        } else {
            dd('c_tasksGraphArray is not set!');
        }
    }

    public function toggleFlattened()
    {
        $this->c_flattened = !$this->c_flattened;
    }

    public function setTopOffsetToZero()
    {
        foreach ($this->c_tasksGraphArray as &$task) {
            $task['top'] = 'top:0';
        }
    }
    public function setTaskPositionType()
    {
        foreach ($this->c_tasksGraphArray as &$task) {
            $task['position'] = ($this->c_flattened ? 'absolute' : 'relative');
        }
    }
    public function setTaskTranslateType()
    {
        foreach ($this->c_tasksGraphArray as &$task) {
            $task['translate'] = ($this->c_flattened ? '' : 'translate-y-full');
        }
    }
    public function calcTaskHeight()
    {
        foreach ($this->c_tasksGraphArray as &$task) {
            $task = json_decode(json_encode($task), true);
            $deltaForNumerator = abs(
                substr($task['ending_time'], 0, 10)
                    -
                    substr($task['starting_time'], 0, 10)
            );
            $deltaForDenumerator = abs(
                substr($this->c_startingDatepoint_unix, 0, 10)
                    -
                    substr($this->c_endingDatepoint_unix, 0, 10)
            );

            $task['height'] = "height:" .
                (substr(
                    (100 *
                        abs(
                            ($deltaForNumerator)
                                /
                                ($deltaForDenumerator)
                        )
                    ),
                    0,
                    5
                )
                )
                . "%";
        }
    }
    public function calcTaskTopOffset()
    {
        foreach ($this->c_tasksGraphArray as &$task) {
            $task = json_decode(json_encode($task), true);
            $deltaForNumerator = abs(
                substr($this->c_startingDatepoint_unix, 0, 10)
                    -
                    substr($task['starting_time'], 0, 10)
            );
            $deltaForDenumerator = abs(
                substr($this->c_startingDatepoint_unix, 0, 10)
                    -
                    substr($this->c_endingDatepoint_unix, 0, 10)
            );
            $task['top'] = "top:" .
                substr(
                    (100 * (
                        ($deltaForNumerator)
                        /
                        ($deltaForDenumerator)
                    )
                    ),
                    0,
                    5
                )
                . "%";
        }
    }
    public function getTask()
    {
        // $user_settings = DB::table('user_settings')->where('user_id', Auth::user()->id)->first();
        // Manual → Auto ▼
        // $dateTimezone = new DateTimeZone('asia/tehran');
        // $dateTimezone = new DateTimeZone('$user_settings');
        // $starting_hour = $user_settings->starting_hour;
        // $starting_minute = $user_settings->starting_minute;
        // $starting_second = 0;
        // $starting_dateTime = new DateTime();
        // $starting_dateTime->setTimestamp(time());
        // $starting_dateTime->setTimezone($dateTimezone);
        // $starting_dateTime->setTime($starting_hour, $starting_minute, $starting_second);

        // $ending_hour = $user_settings->ending_hour;
        // $ending_minute = $user_settings->ending_minute;
        // $ending_second = 00;
        // $ending_dateTime = new DateTime();
        // $ending_dateTime->setTimestamp(time());
        // $ending_dateTime->setTimezone($dateTimezone);
        // $ending_dateTime->setTime($ending_hour, $ending_minute, $ending_second);

        // dd($starting_dateTime, $ending_dateTime);
        // Set the database variables into livewire variables

        // $this->c_startingDatepoint_unix = $starting_dateTime->format('U');
        // $this->c_endingDatepoint_unix = $ending_dateTime->format('U');

        // $this->c_startingDate = $starting_dateTime->format('Y-m-d');
        // $this->c_endingDate = $ending_dateTime->format('Y-m-d');

        // $this->c_startingHourpoint = $starting_dateTime->format('H:i');
        // $this->c_endingHourpoint =  $ending_dateTime->format('H:i');

        // $this->is_date_different = $user_settings->is_date_different;

        // Setting variables into database is here //
        // if ($this->c_startingDate == $this->c_endingDate) {
            // If the `is_date_different` is true, then change it to false. Otherwise do not call the database.
            // if ($user_settings->is_date_different) {
                // If the dates are equal, they are not different
                // DB::table('user_settings')->update([
                    // 'is_date_different' => false
                // ]);
            // }
        // } else {
            // If the `is_date_different` is false, then change it to true. Otherwise do not call the database.
            // if (!($user_settings->is_date_different)) {
                // If the dates are not equal, they are different
                // DB::table('user_settings')->update([
                    // 'is_date_different' => true
                // ]);
            // }
        // }

        // dd($this->c_startingHourpoint, $starting_dateTime->format('H:i'));
        // if (!($this->c_startingHourpoint == $starting_dateTime->format('H:i'))) {
            // dd(($this->c_startingHourpoint == $starting_dateTime->format('H:i')));
            // DB::table('user_settings')->update([
                // 'starting_hour' => substr($this->c_startingHourpoint, 0, 2),
                // 'starting_minute' => substr($this->c_endingHourpoint, 3, 2),
            // ]);
        // }


        $this->c_flattened = false;

        // dd($this->c_startingDatepoint_unix,$this->c_endingDatepoint_unix);

        (is_null($this->c_startingDatepoint_unix) || is_null($this->c_endingDatepoint_unix)) ?
            dd('Parameter has not been found!') :
            $this->c_tasksGraphArray = DB::table('tasks')
            ->select('tasks.*', 'categories.category', 'categories.description', 'categories.color')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->where('tasks.user_id', Auth::user()->id)
            ->where('starting_time', '>=', substr($this->c_startingDatepoint_unix, 0, 10))
            ->where('starting_time', '<', substr($this->c_endingDatepoint_unix, 0, 10))
            ->orderBy('starting_time')
            ->get()->toArray();
        $this->calcTaskHeight();
        // You may wonder: Why did I add this custom made foreach loop, while I could have used the `setTaskPositionType()`?
        // Because of the initial state and timeline. The timeline does not match the correct corresponding according to the `c_flattened :bool`
        foreach ($this->c_tasksGraphArray as &$task) {
            $task['position'] = 'absolute';
        }
        $this->calcTaskTopOffset();
    }

    public function getTimeAndDate()
    {
    }

    public function setTimeAndDate()
    {
    }

    public function isDateDifferent_Changer()
    {
        // detects if the dates are not equal
    }
}
