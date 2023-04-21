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
    protected $listeners = ['$refresh', 'sendBackId'];
    public $sendBackId;
    public $confirming;
    // public $allTasks;
    // protected $listeners = ['refreshComponent' => '$refresh'];
    protected $layout = null;

    public function render()
    {
        // you have to send it through an array after the view
        return view('livewire.tasks-table', [
            'sendBackId' => $this->sendBackId,
            // 'allTasks' => TaskModel::select('tasks.*', 'categories.category', 'categories.description')
            // ->join('categories', 'tasks.category_id', '=', 'categories.id')
            // ->orderBy('starting_time', 'DESC')
            // ->where('tasks.user_id',Auth::user()->id)
            // ->paginate(5),
            'allTasks' => DB::table('tasks')->select('tasks.*', 'categories.category', 'categories.description','categories.color')
                ->join('categories', 'tasks.category_id', '=', 'categories.id')
                ->where('tasks.user_id', Auth::user()->id)
                ->orderByDesc('starting_time')
                ->paginate(5)
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

    public function confirmDelete($id){
        $this->confirming = $id;
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
