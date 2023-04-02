<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CustomGraphX extends Component
{
    public $startingHourpoint;
    public $endingHourpoint;
    // public $startingDatepoint_unix = '1679927400';
    // public $endingDatepoint_unix = 1679948940 + (4* 86400);
    public $startingDatepoint_unix;
    public $endingDatepoint_unix;
    public $tasksGraphArray;
    public $startingDate;
    public $endingDate;
    public $flattened;
    public $seperatedTasks;

    public function render()
    {
        return view('livewire.custom-graph-x');
        // dd('livewire.custom-graph-x');
    }
    public function mount()
    {
        $this->startingDatepoint_unix = '1679927400';
        $this->endingDatepoint_unix = 1679948940 + (4* 86400);
        $this->flattened = false;
        $this->startingHourpoint = '18:00';
        $this->endingHourpoint = '23:59';
        $this->startingDate = '2023-03-27';
        $this->endingDate = '2023-03-27';
    }

    /**
     * Seperates task's of arrays into a 2D array
     * Each array represents all tasks of a day
     * @param array $array
     * @return array $2dArray
     */
    public function seperateTasksIntoDays($array)
    {
        if (empty($array)) {
            dd('seperateTasksIntoDays: Given array is empty', $array);
        }
        $modified_array = array();
        $days = $this->modByDays($this->startingDatepoint_unix, $this->endingDatepoint_unix);
        for ($x = 0; $x < $days + 1; $x++) {
            $modified_array[$x] = array_values(
                array_filter(
                    $array,
                    function ($task) use ($x) {
                        return (
                            $task['starting_time'] >= $this->addDays($this->startingDatepoint_unix, $x)
                            &&
                            $task['starting_time'] < $this->addDays($this->startingDatepoint_unix, $x + 1)
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
        if (isset($this->tasksGraphArray)) {
            if ($this->flattened) {
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
            dd('tasksGraphArray is not set!');
        }
    }
    public function toggleFlattened()
    {
        $this->flattened = !$this->flattened;
    }
    public function setLeftOffsetToZero()
    {
        foreach ($this->tasksGraphArray as &$task) {
            $task['left'] = 'left:0';
        }
    }
    public function setTaskPositionType()
    {
        foreach ($this->tasksGraphArray as &$task) {
            $task['position'] = ($this->flattened ? 'absolute' : 'relative');
        }
    }
    public function setTaskTranslateType()
    {
        foreach ($this->tasksGraphArray as &$task) {
            $task['translate'] = ($this->flattened ? '' : 'translate-y-full');
        }
    }

    /**
     * @param array 2D Array
     */

    public function calcTaskWidthForSeperatedTasks($array)
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
                    substr($this->addDays($this->startingDatepoint_unix, $x), 0, 10)
                    -
                    substr($this->addDays($this->endingDatepoint_unix, (-1 * $rows) + 1 + $x), 0, 10)
                );
                $array[$x][$y]['width'] = "width:" .
                    (
                        substr(
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

    public function calcTaskOffsetForSeperatedTasks($array)
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
                    substr($this->addDays($this->startingDatepoint_unix, $x), 0, 10)
                );
                $deltaForDenumerator = abs(
                    substr($this->addDays($this->startingDatepoint_unix, $x), 0, 10)
                    -
                    substr($this->addDays($this->endingDatepoint_unix, (-1 * $rows) + 1 + $x), 0, 10)
                );
                $array[$x][$y]['left'] = "left:" .
                    (
                        substr(
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

    public function getTask()
    {
        $this->flattened = false;
        (is_null($this->startingDatepoint_unix) || is_null($this->endingDatepoint_unix)) ?
            dd('Parameter has not been found!') :
            $this->tasksGraphArray = DB::table('tasks')
                ->where('starting_time', '>=', substr($this->startingDatepoint_unix, 0, 10))
                ->where('starting_time', '<', substr($this->endingDatepoint_unix, 0, 10))
                ->orderBy('starting_time')
                ->get()->toArray();
        // You may wonder: Why did I add this custom made foreach loop, while I could have used the `setTaskPositionType()`?
        // Because of the initial state and timeline. The timeline does not match the correct corresponding according to the `flattened :bool`
        // foreach ($this->tasksGraphArray as &$task) {
        // $task['position'] = 'absolute';
        // }
        $this->tasksGraphArray = $this->stdclassToArray($this->tasksGraphArray);
        $this->seperatedTasks = $this->seperateTasksIntoDays($this->tasksGraphArray);
        $this->seperatedTasks = $this->calcTaskWidthForSeperatedTasks($this->seperatedTasks);
        $this->seperatedTasks = $this->calcTaskOffsetForSeperatedTasks($this->seperatedTasks);
        // dd(($this->seperatedTasks));

        // dd(DB::table('tasks')
        // ->where([
        // ['starting_time', '>=', substr($this->startingDatepoint_unix, 0, 10)],
        // ['starting_time', '<', substr($this->endingDatepoint_unix, 0, 10)]
        // ])->get());
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