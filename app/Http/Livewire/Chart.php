<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart extends Component
{
    //---------------------THIS COMPONENT NOT WORKING. FOR WHATEVER REASON IDK.---------------------//
    // When does your "day" starts and when does it ends?
    // public $startingDatepoint;
    // public $endingDatepoint;
    // public $results;

    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.chart');
    }

    public function getTasks()
    {
        dd('getTasks');
        // $this->results = DB::table('tasks')->select('*')->get();
    }
}
