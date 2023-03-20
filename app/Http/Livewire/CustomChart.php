<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CustomChart extends Component
{
    public $startingDatepoint;
    public $endingDatepoint;
    public $startingDatepoint_unix;
    public $endingDatepoint_unix;

    public function render()
    {
        return view('livewire.custom-chart');
    }

    public function getTask()
    {
        // dd(substr($this->startingDatepoint_unix,0,10),substr($this->endingDatepoint_unix,0,10));
        // (is_null($this->startingDatepoint_unix) || is_null($this->endingDatepoint_unix))?
        (is_null($this->startingDatepoint_unix)||is_null($this->endingDatepoint_unix))?
         dd('Parameter has not been found!') :
        //  dd(DB::table('tasks')->get());
         dd(DB::table('tasks')
                ->where('starting_time', '>=', substr($this->startingDatepoint_unix,0,10))
                ->where('starting_time', '<', substr($this->endingDatepoint_unix,0,10))
                ->orderBy('starting_time')
                ->get());
                // dd(DB::table('tasks')
                // ->where([
                    // ['starting_time', '>=', substr($this->startingDatepoint_unix, 0, 10)],
                    // ['starting_time', '<', substr($this->endingDatepoint_unix, 0, 10)]
                // ])->get());
    }
}
