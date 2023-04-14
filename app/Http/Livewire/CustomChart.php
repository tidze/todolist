<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CustomChart extends Component
{
    public $c_startingHourpoint;
    public $c_endingHourpoint;
    public $c_startingDatepoint_unix;
    public $c_endingDatepoint_unix;
    public $c_tasksGraphArray;
    public $c_startingDate;
    public $c_endingDate;
    public $c_flattened;

    public function mount()
    {
        $this->c_startingDatepoint_unix = '1680703200' + (9 * 86400);
        $this->c_endingDatepoint_unix = '1680726480' + (9 * 86400);
        $this->c_flattened = false;
        $this->c_startingHourpoint = '18:00';
        $this->c_endingHourpoint = '23:59';
        $this->c_startingDate = '2023-03-27';
        $this->c_endingDate = '2023-03-27';
    }

    public function render()
    {
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
        $this->c_flattened = false;

        // dd($this->c_startingDatepoint_unix,$this->c_endingDatepoint_unix);

        (is_null($this->c_startingDatepoint_unix) || is_null($this->c_endingDatepoint_unix)) ?
            dd('Parameter has not been found!') :
            $this->c_tasksGraphArray = DB::table('tasks')
            ->select('tasks.*', 'categories.category', 'categories.description', 'categories.color')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
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
        // dd($this->c_tasksGraphArray);
        // dd(DB::table('tasks')
        // ->where([
        // ['starting_time', '>=', substr($this->c_startingDatepoint_unix, 0, 10)],
        // ['starting_time', '<', substr($this->c_endingDatepoint_unix, 0, 10)]
        // ])->get());
    }
}
