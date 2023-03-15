<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Task as TaskModel;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Facades\DB;

class Task extends Component
{
    public $taskCategory;
    public $taskDescription;
    public $desiredDuration;
    public $startingTimepoint_obj;
    public $endingTimepoint_obj;
    public $startingTimepoint;
    public $endingTimepoint;
    public $startingDatepoint;
    public $endingDatepoint;
    public $targetTaskIdEdit;
    // detector for whether it should be update or store fucntion (any parameter that contains 9, store has been choosen)
    public $detector;
    public $_88 = 88;
    public $_99 = 99;
    // since we're calling editTask from tasks-table component's controller we need to register our function controller
    protected $listeners = ['editTask'];

    public function mount()
    {
        $this->endingTimepoint_obj = '';
        $this->startingTimepoint_obj = '';
        // the starting time for "clock time picker" ought to be current time. for now we leave it at 00:00
        $this->startingTimepoint = '00:00';
        $this->endingTimepoint = '00:00';
        $this->desiredDuration = '';
        $this->taskCategory = '';
        $this->taskDescription = '';
    }

    public function render()
    {
        return view('livewire.task');
    }

    public function storeOrUpdate($detector)
    {
        // if the coming parameter is update do update function else do store function
        (str_contains($detector, 9)) ? $this->detector = $this->_99 : $this->detector = $this->_88;
        (str_contains($detector, 9)) ? $this->store() : $this->update();
    }

    // incoming request from tasks-table anchor tag
    public function editTask($id)
    {
        $this->targetTaskIdEdit = $id;

        $task = TaskModel::select('tasks.*', 'categories.category', 'categories.description')->join('categories', 'tasks.category_id', '=', 'categories.id')->get()->find($this->targetTaskIdEdit);
        $this->taskCategory = $task->category;
        $this->taskDescription = $task->description;
        $this->desiredDuration = $task->desired_duration;
        // turn it into each time zone , this fix is temporary
        $this->startingTimepoint_obj = $task->starting_time * 1000;
        $this->endingTimepoint_obj = $task->ending_time * 1000;
        $this->startingTimepoint =  date("H:i", $task->starting_time+12600);
        $this->endingTimepoint = date("H:i", $task->ending_time+12600);
        // send back the targetTaskIdEdit to tasks-table
        $this->emitTo('tasks-table', 'sendBackId', $this->targetTaskIdEdit);
    }

    public function update()
    {
        $this->validate([
            'targetTaskIdEdit' => ['required'],
            'startingTimepoint_obj' => ['required'],
            'endingTimepoint_obj' => ['required'],
            'desiredDuration' => ['required'],
            'taskCategory' => ['required'],
            'taskDescription' => ['required'],
        ]);
        $category = Task::checkForExistingCategory(trim($this->taskCategory), trim($this->taskDescription));
        if (is_null($category)) {
            // if the category not exists, add the category to the categories table and then update the task
            Task::insertIntoCategories(trim($this->taskCategory), trim($this->taskDescription));
            Task::updateIntoTasks(trim($this->targetTaskIdEdit), trim($this->taskCategory), trim($this->taskDescription));
        } else {
            // if the category exists, just retrive the id from categories table and update it with category_id
            Task::updateIntoTasks(trim($this->targetTaskIdEdit), trim($this->taskCategory), trim($this->taskDescription));
        }
        $this->resetErrorBag();
    }

    public function deleteTask($id)
    {
        TaskModel::findOrFail($id)->delete();
    }

    public function store()
    {
        $this->validate([
            'startingTimepoint_obj' => ['required'],
            'endingTimepoint_obj' => ['required'],
            'desiredDuration' => ['required'],
            'taskCategory' => ['required'],
            'taskDescription' => ['required'],
        ]);

        $category = Task::checkForExistingCategory(trim($this->taskCategory), trim($this->taskDescription));
        if (is_null($category)) {
            // if the category not exists, add the category to the categories table and then add the task
            Task::insertIntoCategories(trim($this->taskCategory), trim($this->taskDescription));
            Task::insertIntoTasks(trim($this->taskCategory), trim($this->taskDescription));
        } else {
            // if the category exists, just retrive the id from categories table and insert it as category_id
            Task::insertIntoTasks(trim($this->taskCategory), trim($this->taskDescription));
        }
        $this->emitTo('tasks-table', '$refresh');
        $this->taskCategory = '';
        $this->taskDescription = '';
        $this->desiredDuration = '';
        $this->startingTimepoint_obj = '';
        $this->endingTimepoint_obj = '';
        $this->startingTimepoint = '00:00';
        $this->endingTimepoint = '00:00';
        $this->targetTaskIdEdit = '';
        $this->emitTo('tasks-table', 'sendBackId', $this->targetTaskIdEdit);
        $this->resetErrorBag();
    }

    public function checkForExistingCategory($category, $description)
    {
        return CategoryModel::where('category', $category)->where('description', $description)->first();
    }

    public function insertIntoCategories($category, $description)
    {
        $categoryModel = new CategoryModel;
        $categoryModel->category = $category;
        $categoryModel->description = $description;
        $categoryModel->save();
    }

    public function insertIntoTasks($category, $description)
    {
        $taskModel = new TaskModel;
        $retrievedCategory = Task::checkForExistingCategory($category, $description);
        $taskModel->category_id = $retrievedCategory->id;
        $taskModel->desired_duration = $this->desiredDuration;
        // The UnixEpoch in js is in miliseconds, while php is in seconds.
        $taskModel->starting_time = substr($this->startingTimepoint_obj, 0, 10);
        $taskModel->ending_time = substr($this->endingTimepoint_obj, 0, 10);
        $taskModel->save();
    }

    public function updateIntoTasks($taskId, $category, $description)
    {
        $retrievedCategory = Task::checkForExistingCategory($category, $description);
        DB::table('tasks')->where('id', $taskId)
            ->update([
                'category_id' => $retrievedCategory->id,
                'desired_duration' => $this->desiredDuration,
                'starting_time' => substr($this->startingTimepoint_obj, 0, 10),
                'ending_time' => substr($this->endingTimepoint_obj, 0, 10),
            ]);
        $this->emitTo('tasks-table', '$refresh');
        $this->taskCategory = '';
        $this->taskDescription = '';
        $this->desiredDuration = '';
        $this->startingTimepoint_obj = '';
        $this->endingTimepoint_obj = '';
        $this->startingTimepoint = '00:00';
        $this->endingTimepoint = '00:00';
        $this->targetTaskIdEdit = '';
    }
}
