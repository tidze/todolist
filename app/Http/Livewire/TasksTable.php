<?php

namespace App\Http\Livewire;

use App\Models\Task as TaskModel;
use Livewire\Component;

class TasksTable extends Component
{
    protected $listeners = ['$refresh','sendBackId'];
    public $sendBackId;
    // protected $listeners = ['refreshComponent' => '$refresh'];
    protected $layout = null;

    public function render()
    {
        return view('livewire.tasks-table', [
            'allTasks' => TaskModel::select('tasks.*', 'categories.category', 'categories.description')->join('categories', 'tasks.category_id', '=', 'categories.id')->orderBy('starting_time')->get(),
            'sendBackId' => $this->sendBackId
        ]);
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
