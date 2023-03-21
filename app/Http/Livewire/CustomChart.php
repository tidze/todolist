<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CustomChart extends Component
{
    public $startingHourpoint;
    public $endingHourpoint;
    public $startingDatepoint_unix;
    public $endingDatepoint_unix;
    public $tasksGraphArray;
    public $startingDate;
    public $endingDate;

    public function mount(){
        $this->startingHourpoint = '00:00';
        $this->endingHourpoint = '23:59';
        // $this->startingDate = '2023-03-20';
        // $this->endingDate ='2023-03-20';

    }

    public function render()
    {
        return view('livewire.custom-chart');
    }

    public function getTask()
    {
        (is_null($this->startingDatepoint_unix) || is_null($this->endingDatepoint_unix)) ?
            dd('Parameter has not been found!') :
            $this->tasksGraphArray = DB::table('tasks')
            ->where('starting_time', '>=', substr($this->startingDatepoint_unix, 0, 10))
            ->where('starting_time', '<', substr($this->endingDatepoint_unix, 0, 10))
            ->orderBy('starting_time')
            ->get()->toArray();
        // dd(DB::table('tasks')
        // ->where([
        // ['starting_time', '>=', substr($this->startingDatepoint_unix, 0, 10)],
        // ['starting_time', '<', substr($this->endingDatepoint_unix, 0, 10)]
        // ])->get());
    }
}
