<?php

namespace App\Http\Livewire;

use App\Models\Task as TaskModel;
use Livewire\Component;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination;
    protected $listeners = ['$refresh', 'sendBackId'];
    public $sendBackId;
    // public $allTasks;
    // protected $listeners = ['refreshComponent' => '$refresh'];
    protected $layout = null;

    public function render()
    {
        // you have to send it through an array after the view
        return view('livewire.tasks-table', [
            'sendBackId' => $this->sendBackId,
            'allTasks' => TaskModel::select('tasks.*', 'categories.category', 'categories.description')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->orderBy('starting_time', 'DESC')
            ->paginate(5),
        ]);
    }

    public function getAllTasks()
    {
        // $this->allTasks = TaskModel::select('tasks.*', 'categories.category', 'categories.description')
                                    // ->join('categories', 'tasks.category_id', '=', 'categories.id')
                                    // ->orderBy('starting_time', 'DESC')
                                    // ->paginate(2);
                                    // ->items();
                                    // $this->allTasks= TaskModel::paginate(2);
        // dd($this->allTasks);
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
