<?php

namespace App\Http\Livewire;

use App\Models\Task as TaskModel;
use Livewire\Component;

class TasksTable extends Component
{
    protected $listeners = ['$refresh','sendBackId'];
    public $sendBackId;
    public $allTasks;
    // protected $listeners = ['refreshComponent' => '$refresh'];
    protected $layout = null;

    public function render()
    {
        $this->getAllTasks();
        return view('livewire.tasks-table', [
            'sendBackId' => $this->sendBackId
        ]);
    }

    public function getAllTasks(){
        $this->allTasks = TaskModel::select('tasks.*', 'categories.category', 'categories.description')->join('categories', 'tasks.category_id', '=', 'categories.id')->orderBy('starting_time','DESC')->get();
    }

    public function deleteTask($id)
    {
        TaskModel::findOrFail($id)->delete();
        // TaskModel::findOrFail($this->deleteId)->delete();
        // dd($targetTask);
        // $this->emit('refreshComponent');
    }

    public function edit($id)
    {
        $this->emitTo('task', 'editTask', $id);
    }

    public function sendBackId($id)
    {
        $this->sendBackId = $id;
    }
}
