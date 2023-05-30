<?php

namespace App\Http\Livewire;

use App\Models\Task as TaskModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination;
    protected $listeners = ['$refresh', 'sendBackId','targetTaskIdSetter'];
    public $sendBackId;
    public $confirming;
    // public $allTasks;
    // protected $listeners = ['refreshComponent' => '$refresh'];
    protected $layout = null;

    public $targetTaskIdEdit;

    // protected $listeners = ['targetTaskIdSetter'];

    public function render()
    {
        // you have to send it through an array after the view
        return view('livewire.tasks-table', [
            'allTasks' => DB::table('tasks')->select('tasks.*', 'categories.category', 'categories.description', 'categories.color')
                ->join('categories', 'tasks.category_id', '=', 'categories.id')
                ->where('tasks.user_id', Auth::user()->id)
                ->orderByDesc('starting_time')
                ->paginate(5),
            'targetTaskIdEdit' => $this->targetTaskIdEdit,
        ]);
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function deleteTask($id)
    {
        TaskModel::findOrFail($id)->delete();
    }

    public function targetTaskIdSetter($id){
        $this->targetTaskIdEdit = $id;
    }

    public function edit($id)
    {
        $this->emitTo('task', 'editTask', $id);
        $this->emitTo('custom-chart', 'targetTaskIdSetter', $id);
        $this->targetTaskIdSetter($id);
    }

    public function sendBackId($id)
    {
        $this->sendBackId = $id;
    }
}
