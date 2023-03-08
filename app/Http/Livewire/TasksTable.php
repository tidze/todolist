<?php

namespace App\Http\Livewire;

use App\Models\Task as TaskModel;
use Livewire\Component;

class TasksTable extends Component
{
    protected $listeners = ['$refresh'];

    public function render()
    {
        return view('livewire.tasks-table',[
            'allTasks'=>TaskModel::select('tasks.*','categories.category','categories.description')->join('categories','tasks.category_id','=','categories.id')->get()
        ]);


    }
}
