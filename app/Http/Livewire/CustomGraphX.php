<?php

namespace App\Http\Livewire;

use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class CustomGraphX extends Component
{
    public $x_startingHour;
    public $x_endingHour;
    public $x_startingDatepoint_unix;
    public $x_endingDatepoint_unix;
    public $x_tasksGraphArray;
    public $x_startingDate;
    public $x_endingDate;
    public $x_flattened;
    public $x_seperatedTasks;

    public function render()
    {
        return view('livewire.custom-graph-x');
        // dd('livewire.custom-graph-x');
    }
    public function mount()
    {
        $this->x_startingDatepoint_unix = '1680703200' + (6 * 86400);
        $this->x_endingDatepoint_unix = '1680726480' + (10 * 86400);
        $this->x_flattened = false;
        // $this->x_startingHour = '18:00';
        // $this->x_endingHour = '23:59';
        $this->x_startingHour = date('H:i', substr($this->x_startingDatepoint_unix, 0, 10) + 12600);
        $this->x_endingHour = date('H:i', substr($this->x_endingDatepoint_unix, 0, 10) + 12600);
        $this->x_startingDate = date('Y-m-d', substr($this->x_startingDatepoint_unix, 0, 10) + 12600);
        $this->x_endingDate = date('Y-m-d', substr($this->x_startingDatepoint_unix, 0, 10) + 12600);
    }

    /**
     * Seperates task's of arrays into a 2D array
     * Each array represents all tasks of a day
     * @param array $array
     * @return array $2dArray
     */
    public function seperateTasksIntoDays($array, $starting_unix, $ending_unix)
    {

        if (empty($array)) {
            dd('seperateTasksIntoDays: Given array is empty', 'It may be no tasks in the zone', $array);
        }
        $modified_array = array();
        $days = $this->modByDays($starting_unix, $ending_unix);
        for ($x = 0; $x < $days + 1; $x++) {
            $modified_array[$x] = array_values(
                array_filter(
                    $array,
                    function ($task) use ($x, $starting_unix) {
                        return ($task['starting_time'] >= $this->addDays($starting_unix, $x)
                            &&
                            $task['starting_time'] < $this->addDays($starting_unix, $x + 1)
                        );
                    }
                )
            );
        }
        return $modified_array;
    }
    public function flattenTasksGraph()
    {
        // $this->seperateTasksIntoDay();
        // $this->calcTaskWidthForSeperatedTasks();

        // dd('how to die dumb ways');
        if (isset($this->x_tasksGraphArray)) {
            if ($this->x_flattened) {
                $this->calcTaskLeftOffset();

                $this->setTaskPositionType();
                $this->setTaskTranslateType();
            } else {
                $this->setLeftOffsetToZero();

                $this->setTaskPositionType();
                $this->setTaskTranslateType();
            }
            $this->toggleFlattened();
        } else {
            dd('x_tasksGraphArray is not set!');
        }
    }
    public function toggleFlattened()
    {
        $this->x_flattened = !$this->x_flattened;
    }
    public function setLeftOffsetToZero()
    {
        foreach ($this->x_tasksGraphArray as &$task) {
            $task['left'] = 'left:0';
        }
    }
    public function setTaskPositionType()
    {
        foreach ($this->x_tasksGraphArray as &$task) {
            $task['position'] = ($this->x_flattened ? 'absolute' : 'relative');
        }
    }
    public function setTaskTranslateType()
    {
        foreach ($this->x_tasksGraphArray as &$task) {
            $task['translate'] = ($this->x_flattened ? '' : 'translate-y-full');
        }
    }

    /**
     * @param array 2D Array
     */
    public function calcTaskWidthForSeperatedTasks($array, $starting_unix, $ending_unix)
    {
        if (empty($array)) {
            dd('calcTaskWidthForSeperatedTasks: Given array is empty', $array);
        }
        if (!($this->is_multi_array($array))) {
            dd('calcTaskWidthForSeperatedTasks: Given array is not multi dimention', $array);
        }
        $rows = count($array);
        $cols = count($array[0]);

        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < (count($array[$x])); $y++) {
                $deltaForNumerator = abs(
                    substr($array[$x][$y]['ending_time'], 0, 10)
                        -
                        substr($array[$x][$y]['starting_time'], 0, 10)
                );
                $deltaForDenumerator = abs(
                    substr($this->addDays($starting_unix, $x), 0, 10)
                        -
                        substr($this->addDays($ending_unix, (-1 * $rows) + 1 + $x), 0, 10)
                );
                $array[$x][$y]['width'] = "width:" .
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
        return $array;
    }

    public function calcTaskOffsetForSeperatedTasks($array, $starting_unix, $ending_unix)
    {
        if (empty($array)) {
            dd('calcTaskWidthForSeperatedTasks: Given array is empty', $array);
        }
        if (!($this->is_multi_array($array))) {
            dd('calcTaskWidthForSeperatedTasks: Given array is not multi dimention', $array);
        }
        $rows = count($array);
        $cols = count($array[0]);

        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < (count($array[$x])); $y++) {
                $deltaForNumerator = abs(
                    substr($array[$x][$y]['starting_time'], 0, 10)
                        -
                        substr($this->addDays($starting_unix, $x), 0, 10)
                );
                $deltaForDenumerator = abs(
                    substr($this->addDays($starting_unix, $x), 0, 10)
                        -
                        substr($this->addDays($ending_unix, (-1 * $rows) + 1 + $x), 0, 10)
                );
                // dd(substr($this->addDays($this->x_startingDatepoint_unix, $x), 0, 10),substr($this->addDays($this->x_endingDatepoint_unix, (-1 * $rows) + 1 + $x), 0, 10));
                if ($deltaForDenumerator == 0) {
                    $array[$x][$y]['left'] = "left:" . 0 . "%";
                } else {
                    $array[$x][$y]['left'] = "left:" .
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
        }
        return $array;
    }

    public function getTask()
    {
        $this->x_flattened = false;
        (is_null($this->x_startingDatepoint_unix) || is_null($this->x_endingDatepoint_unix)) ?
            dd('Parameter has not been found!') :
            $this->x_tasksGraphArray = DB::table('tasks')
            ->select('tasks.*', 'categories.category', 'categories.description', 'categories.color')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->where('tasks.user_id', Auth::user()->id)
            // date('Y-m-d', (substr($x_startingDatepoint_unix, 0, 10)+12600))
            ->where('starting_time', '>=', substr($this->x_startingDatepoint_unix, 0, 10))
            ->where('starting_time', '<', substr($this->x_endingDatepoint_unix, 0, 10))
            ->orderBy('starting_time')
            ->get()->toArray();
        // dd($this->x_tasksGraphArray);
        // You may wonder: Why did I add this custom made foreach loop, while I could have used the `setTaskPositionType()`?
        // Because of the initial state and timeline. The timeline does not match the correct corresponding according to the `x_flattened :bool`
        // foreach ($this->x_tasksGraphArray as &$task) {
        // $task['position'] = 'absolute';
        // }
        $this->x_tasksGraphArray = $this->stdclassToArray($this->x_tasksGraphArray);
        $this->x_seperatedTasks = $this->seperateTasksIntoDays($this->x_tasksGraphArray, substr($this->x_startingDatepoint_unix, 0, 10), substr($this->x_endingDatepoint_unix, 0, 10));
        $this->x_seperatedTasks = $this->calcTaskWidthForSeperatedTasks($this->x_seperatedTasks, substr($this->x_startingDatepoint_unix, 0, 10), substr($this->x_endingDatepoint_unix, 0, 10));
        $this->x_seperatedTasks = $this->calcTaskOffsetForSeperatedTasks($this->x_seperatedTasks, substr($this->x_startingDatepoint_unix, 0, 10), substr($this->x_endingDatepoint_unix, 0, 10));
        $this->x_seperatedTasks = array_reverse($this->x_seperatedTasks);
        // dd(DB::table('tasks')
        // ->where([
        // ['starting_time', '>=', substr($this->x_startingDatepoint_unix, 0, 10)],
        // ['starting_time', '<', substr($this->x_endingDatepoint_unix, 0, 10)]
        // ])->get());
    }

    public function getTaskForPastSevenDays()
    {
        $ending_datetime = new DateTime();
        $timezone = new DateTimeZone('asia/tehran');
        $ending_datetime->setTimezone($timezone);
        $ending_datetime->setTimestamp(time());
        $ending_datetime->setTime(23, 59, 00);
        // Agha , timezone ro set bokonan dg. badesh timestamp begiran.
        $starting_datetime = new DateTime();
        $starting_datetime->setTimezone($timezone);
        $starting_datetime->setTimestamp(time());
        $starting_datetime->setTime(16, 15, 00);

        $interval = new DateInterval('P7D');
        $starting_datetime->sub($interval);
        $this->x_flattened = false;

        $this->x_tasksGraphArray = DB::table('tasks')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->where('tasks.user_id', Auth::user()->id)
            ->where('starting_time', '>=', $starting_datetime->getTimestamp())
            ->where('starting_time', '<', $ending_datetime->getTimestamp())
            ->orderBy('starting_time', 'desc')
            ->get()->toArray();
        // dd($this->x_tasksGraphArray);
        // dd('We are here: getTaskForPastSevenDays()',
        //    '$this->x_tasksGraphArray',
        //    $this->x_tasksGraphArray,
        //    '$ending_datetime',
        //    $ending_datetime,
        //    $ending_datetime->getTimestamp(),
        //    '$starting_datetime',
        //    $starting_datetime,
        //    $starting_datetime->getTimestamp(),
        // );
        $this->x_tasksGraphArray = $this->stdclassToArray($this->x_tasksGraphArray);
        $this->x_seperatedTasks = $this->seperateTasksIntoDays($this->x_tasksGraphArray, $starting_datetime->getTimestamp(), $ending_datetime->getTimestamp());
        $this->x_seperatedTasks = $this->calcTaskWidthForSeperatedTasks($this->x_seperatedTasks, $starting_datetime->getTimestamp(), $ending_datetime->getTimestamp());
        $this->x_seperatedTasks = $this->calcTaskOffsetForSeperatedTasks($this->x_seperatedTasks, $starting_datetime->getTimestamp(), $ending_datetime->getTimestamp());
        $this->x_seperatedTasks = array_reverse($this->x_seperatedTasks);
        $this->x_startingDatepoint_unix = $starting_datetime->getTimestamp();
        $this->x_endingDatepoint_unix = $ending_datetime->getTimestamp();
        // dd($this->x_seperatedTasks);
    }

    public function getTaskForPastThirtyDays()
    {
        $ending_datetime = new DateTime();
        $timezone = new DateTimeZone('asia/tehran');
        $ending_datetime->setTimezone($timezone);
        $ending_datetime->setTimestamp(time());
        $ending_datetime->setTime(23, 59, 00);
        // Agha , timezone ro set bokonan dg. badesh timestamp begiran.
        $starting_datetime = new DateTime();
        $starting_datetime->setTimezone($timezone);
        $starting_datetime->setTimestamp(time());
        $starting_datetime->setTime(16, 30, 00);

        $interval = new DateInterval('P30D');
        $starting_datetime->sub($interval);
        $this->x_flattened = false;

        $this->x_tasksGraphArray = DB::table('tasks')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->where('tasks.user_id', Auth::user()->id)
            ->where('starting_time', '>=', $starting_datetime->getTimestamp())
            ->where('starting_time', '<', $ending_datetime->getTimestamp())
            ->orderBy('starting_time', 'desc')
            ->get()->toArray();
        $this->x_tasksGraphArray = $this->stdclassToArray($this->x_tasksGraphArray);
        $this->x_seperatedTasks = $this->seperateTasksIntoDays($this->x_tasksGraphArray, $starting_datetime->getTimestamp(), $ending_datetime->getTimestamp());
        $this->x_seperatedTasks = $this->calcTaskWidthForSeperatedTasks($this->x_seperatedTasks, $starting_datetime->getTimestamp(), $ending_datetime->getTimestamp());
        $this->x_seperatedTasks = $this->calcTaskOffsetForSeperatedTasks($this->x_seperatedTasks, $starting_datetime->getTimestamp(), $ending_datetime->getTimestamp());
        $this->x_seperatedTasks = array_reverse($this->x_seperatedTasks);
        $this->x_startingDatepoint_unix = $starting_datetime->getTimestamp();
        $this->x_endingDatepoint_unix = $ending_datetime->getTimestamp();
        // dd($this->x_seperatedTasks);
    }

    public function stdclassToArray($array)
    {
        $__array = $array;
        foreach ($__array as &$arr) {
            $arr = json_decode(json_encode($arr), true);
        }
        return $__array;
    }

    /**
     * Add days to unix time stamp in seconds
     *
     * @param int $unix Unix time stamp in seconds
     * @param int $number Number of days
     * @return int The sum of given 'days' and given 'unix'
     */
    public function addDays($unix, $number)
    {
        return substr($unix, 0, 10) + ($number * 86400);
    }

    /**
     * Get delta's floor of two timestamps
     * @param string|int $unix unix time stamp in seconds
     * @param string|int $_unix unix time stamp in seconds
     * @return string|int Number of days between these 2 timestamps
     */
    public function modByDays($unix, $_unix)
    {
        $unix = substr($unix, 0, 10);
        $_unix = substr($_unix, 0, 10);
        $delta = abs($unix - $_unix);
        $days = (int) floor($delta / 60 / 60 / 24);
        return $days;
    }

    function is_multi_array($array)
    {
        // rsort($array);
        return isset($array[0]) && is_array($array[0]);
    }
}
