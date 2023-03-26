<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CustomChart extends Component
{
    public $startingHourpoint;
    public $endingHourpoint;
    public $startingDatepoint_unix = '1679842800000';
    public $endingDatepoint_unix = '1679862480000';
    public $tasksGraphArray;
    public $startingDate;
    public $endingDate;
    public $flattened;


    public function mount()
    {
        $this->flattened = false;
        $this->startingHourpoint = '18:00';
        $this->endingHourpoint = '23:59';
        $this->startingDate = '2023-03-26';
        $this->endingDate = '2023-03-26';
    }

    public function render()
    {
        return view('livewire.custom-chart');
    }

    public function flattenTasksGraph()
    {
        if (isset($this->tasksGraphArray)) {
            if ($this->flattened) {
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
            dd('tasksGraphArray is not set!');
        }
    }

    public function toggleFlattened()
    {
        $this->flattened = !$this->flattened;
    }

    public function setTopOffsetToZero()
    {
        foreach ($this->tasksGraphArray as &$task) {
            $task['top'] = 'top:0';
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
    public function calcTaskHeight()
    {
        foreach ($this->tasksGraphArray as &$task) {
            $task = json_decode(json_encode($task), true);
            $deltaForNumerator = abs(
                substr($task['ending_time'], 0, 10)
                    -
                    substr($task['starting_time'], 0, 10)
            );
            $deltaForDenumerator = abs(
                substr($this->startingDatepoint_unix, 0, 10)
                    -
                    substr($this->endingDatepoint_unix, 0, 10)
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
        foreach ($this->tasksGraphArray as &$task) {
            $task = json_decode(json_encode($task), true);
            $deltaForNumerator = abs(
                substr($this->startingDatepoint_unix, 0, 10)
                    -
                    substr($task['starting_time'], 0, 10)
            );
            $deltaForDenumerator = abs(
                substr($this->startingDatepoint_unix, 0, 10)
                    -
                    substr($this->endingDatepoint_unix, 0, 10)
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
        $this->flattened = false;

        // dd($this->startingDatepoint_unix,$this->endingDatepoint_unix);

        (is_null($this->startingDatepoint_unix) || is_null($this->endingDatepoint_unix)) ?
            dd('Parameter has not been found!') :
            $this->tasksGraphArray = DB::table('tasks')
            ->where('starting_time', '>=', substr($this->startingDatepoint_unix, 0, 10))
            ->where('starting_time', '<', substr($this->endingDatepoint_unix, 0, 10))
            ->orderBy('starting_time')
            ->get()->toArray();
        $this->calcTaskHeight();
        // You may wonder: Why did I add this custom made foreach loop, while I could have used the `setTaskPositionType()`?
        // Because of the initial state and timeline. The timeline does not match the correct corresponding according to the `flattened :bool`
        foreach ($this->tasksGraphArray as &$task) {
            $task['position'] = 'absolute';
        }
        $this->calcTaskTopOffset();

        // dd(DB::table('tasks')
        // ->where([
        // ['starting_time', '>=', substr($this->startingDatepoint_unix, 0, 10)],
        // ['starting_time', '<', substr($this->endingDatepoint_unix, 0, 10)]
        // ])->get());
    }
}
