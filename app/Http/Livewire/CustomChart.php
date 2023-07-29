<?php

namespace App\Http\Livewire;

use App\Models\Category;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Task as TaskModel;


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

    public $dailyTasks;
    public $c_flattened;

    public $is_date_different;

    public $c_targetTaskIdForEdit;

    public $now = [];

    protected $listeners = ['getTask', 'targetTaskIdSetter'];

    public $taskSumOfDurations;

    public $confirming;

    public $startingDatetime;
    public $endingDatetime;
    public $tasksSortedByDescription_Sum;

    public function mount()
    {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('asia/tehran'));
        $date->setTime(7, 0, 0);
        // $this->startingDatetime = $date;
        $this->c_startingDatepoint_unix = $date->format('U');
        $this->c_startingHourpoint = $date->format('H:i');
        $this->c_startingDate = $date->format('Y-m-d');

        $date->add(new DateInterval('P1D'));
        $date->setTime(03, 00, 0);
        // $this->endingDatetime = $date;
        $this->c_endingDatepoint_unix = $date->format('U');
        $this->c_endingHourpoint = $date->format('H:i');
        $this->c_endingDate = $date->format('Y-m-d');

        $this->c_flattened = false;

        // $date->setTimestamp(time());
        // $this->now['unix'] = $date->format('U');
        $this->calcNow();
        // dd($this->now['unix']);
    }

    public function render()
    {
        return view('livewire.custom-chart', [
            'c_targetTaskIdForEdit_' => $this->c_targetTaskIdForEdit
        ]);
    }

    public function flattenTasksGraph()
    {
        if (isset($this->dailyTasks)) {
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
            dd('dailyTasks is not set!');
        }
    }

    public function toggleFlattened()
    {
        $this->c_flattened = !$this->c_flattened;
    }

    public function setTopOffsetToZero()
    {
        foreach ($this->dailyTasks as &$task) {
            $task['top'] = 'top:0';
        }
    }
    public function setTaskPositionType()
    {
        foreach ($this->dailyTasks as &$task) {
            $task['position'] = ($this->c_flattened ? 'absolute' : 'relative');
        }
    }
    public function setTaskTranslateType()
    {
        foreach ($this->dailyTasks as &$task) {
            $task['translate'] = ($this->c_flattened ? '' : 'translate-y-full');
        }
    }
    public function calcTaskHeight()
    {
        foreach ($this->dailyTasks as &$task) {
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
        foreach ($this->dailyTasks as &$task) {
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
        $this->c_flattened = false;

        (is_null($this->c_startingDatepoint_unix) || is_null($this->c_endingDatepoint_unix)) ?
            dd('Parameter has not been found!') :
            $this->dailyTasks = DB::table('tasks')
            ->select('tasks.*', 'categories.category', 'categories.description', 'categories.color')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->where('tasks.user_id', Auth::user()->id)
            ->where('starting_time', '>=', substr($this->c_startingDatepoint_unix, 0, 10))
            ->where('starting_time', '<', substr($this->c_endingDatepoint_unix, 0, 10))
            ->orderBy('starting_time')
            ->get()->toArray();

        // Sort dailyTasks By their Description
        $uniqueDescriptions = array_unique(array_column($this->dailyTasks, 'description'), SORT_REGULAR);
        $tasksSortedByDescription = [];
        foreach ($uniqueDescriptions as $uniqueDescription) {
            foreach ($this->dailyTasks as $key => $task) {
                if ($task->description == $uniqueDescription) {
                    $tasksSortedByDescription[$uniqueDescription][$key] = abs($task->ending_time - $task->starting_time);
                }
            }
        }


        $tasksSortedByDescription_Sum = [];
        foreach ($tasksSortedByDescription as $key => $value) {
            $tasksSortedByDescription_Sum[$key] = array_sum($value);
        }
        arsort($tasksSortedByDescription_Sum);
        $this->tasksSortedByDescription_Sum = $tasksSortedByDescription_Sum;

        // Sort dailyTasks By their Category
        $uniqueCategories = array_unique(array_column($this->dailyTasks, 'category'), SORT_REGULAR);
        $tasksSortedByCategory = [];
        foreach ($uniqueCategories as $uniqueCategory) {
            foreach ($this->dailyTasks as $key => $task) {
                if ($task->category == $uniqueCategory) {
                    $tasksSortedByCategory[$uniqueCategory][$key] = $task;
                }
            }
        }

        // Calculate duration for each task
        $tasksDuration = [];
        foreach ($tasksSortedByCategory as $categoryIndex => $array) {
            foreach ($array as $taskIndex => $task) {
                $tasksDuration[$categoryIndex][$taskIndex] = abs($task->ending_time - $task->starting_time);
            }
        }

        $taskSumOfDurations = [];
        foreach ($tasksDuration as $categoryIndex => $array) {
            $taskSumOfDurations[$categoryIndex] = array_sum($array);
        }

        arsort($taskSumOfDurations);
        $this->taskSumOfDurations = $taskSumOfDurations;
        // dd($this->taskSumOfDurations);

        $this->calcTaskHeight();
        // You may wonder: Why did I add this custom made foreach loop, while I could have used the `setTaskPositionType()`?
        // Because of the initial state and timeline. The timeline does not match the correct corresponding according to the `c_flattened :bool`
        foreach ($this->dailyTasks as &$task) {
            $task['position'] = 'absolute';
        }
        $this->calcTaskTopOffset();
        $this->c_targetTaskIdForEdit = '';
        $this->calcNow();
        // dd($this->now);
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

    public function prevPeriod()
    {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('asia/tehran'));
        $date->setTimestamp(substr($this->c_startingDatepoint_unix, 0, 10));
        $date->sub(new DateInterval('P1D'));
        $this->c_startingDatepoint_unix = $date->format('U');
        $this->c_startingHourpoint = $date->format('H:i');
        $this->c_startingDate = $date->format('Y-m-d');

        $date->setTimestamp(substr($this->c_endingDatepoint_unix, 0, 10));
        $date->sub(new DateInterval('P1D'));
        $this->c_endingDatepoint_unix = $date->format('U');
        $this->c_endingHourpoint = $date->format('H:i');
        $this->c_endingDate = $date->format('Y-m-d');
        $this->getTask();
    }

    public function nextPeriod()
    {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('asia/tehran'));
        $date->setTimestamp(substr($this->c_startingDatepoint_unix, 0, 10));
        $date->add(new DateInterval('P1D'));
        $this->c_startingDatepoint_unix = $date->format('U');
        $this->c_startingHourpoint = $date->format('H:i');
        $this->c_startingDate = $date->format('Y-m-d');

        $date->setTimestamp(substr($this->c_endingDatepoint_unix, 0, 10));
        $date->add(new DateInterval('P1D'));
        $this->c_endingDatepoint_unix = $date->format('U');
        $this->c_endingHourpoint = $date->format('H:i');
        $this->c_endingDate = $date->format('Y-m-d');
        $this->getTask();
    }

    public function edit($id)
    {
        $this->targetTaskIdSetter($id);
        $this->emitTo('task', 'editTask', $id);
        // $this->emitTo('tasks-table', 'targetTaskIdSetter', $id);
    }

    public function targetTaskIdSetter($id)
    {
        $this->c_targetTaskIdForEdit = $id;
    }

    public function calcNow()
    {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('asia/tehran'));
        $date->setTimestamp(time());
        $this->now['unix'] = $date->format('U');

        $deltaForNumerator = abs(
            substr($this->c_startingDatepoint_unix, 0, 10)
                -
                substr($this->now['unix'], 0, 10)
        );
        $deltaForDenumerator = abs(
            substr($this->c_startingDatepoint_unix, 0, 10)
                -
                substr($this->c_endingDatepoint_unix, 0, 10)
        );
        $this->now['top'] = "top:" .
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

        if (
            ($this->now['unix'] >= $this->c_startingDatepoint_unix)
            &&
            ($this->now['unix'] <= $this->c_endingDatepoint_unix)
        ) {
            $this->now['visible'] = 'visible';
        } else {
            $this->now['visible'] = 'hidden';
        }
        // dd($this->now, $this->c_startingDatepoint_unix, $this->c_endingDatepoint_unix);
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function deleteTask($id)
    {
        // Alternatively, you can use the get() method to retrieve all matching rows and then use the ->first() method on the resulting collection to get the first item
        // DB::table('tasks')->where('id', $id)->delete();
        TaskModel::findOrFail($id)->delete();
        // Later. This is not optimiezed. The funcions are not minimized enough. Just a whole chunk of funtions running again that even may not need to run twice.
        $this->getTask();
    }
}
