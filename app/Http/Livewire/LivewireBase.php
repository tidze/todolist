<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LivewireBase extends Component
{
    public function render()
    {
        return view('livewire.livewire-base');
    }
    public function ducka(){
        dd('LivewireBase ducka');
    }
    public function duck(){
        dd('LivewireBase duck');
    }
    public function duck_post(){
        dd('LivewireBase duck_post');
    }
}
