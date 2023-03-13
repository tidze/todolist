<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Task as TaskModel;
use App\Models\Category as CategoryModel;

class Task extends Component
{
    public $taskCategory;
    public $taskDescription;
    public $desiredDuration;
    public $startingTimepoint_obj;
    public $endingTimepoint_obj;
    public $startingTimepoint;
    public $endingTimepoint;
    public $targetTaskIdEdit;

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

    // incoming request from tasks-table anchor tag
    public function editTask($id)
    {
        $this->targetTaskIdEdit = $id;

        $task = TaskModel::select('tasks.*', 'categories.category', 'categories.description')->join('categories', 'tasks.category_id', '=', 'categories.id')->get()->find($this->targetTaskIdEdit);
        $this->taskCategory= $task->category;
        $this->taskDescription= $task->description;
        $this->desiredDuration = $task->desired_duration;
        $this->startingTimepoint_obj = $task->starting_time;
        $this->endingTimepoint_obj = $task->ending_time;
        // this patch is temporary untill i find a better solution. (what if the time zone is in a different format?)
        $this->startingTimepoint =  substr($task->starting_time, 16, 5);
        $this->endingTimepoint = substr($task->ending_time, 16, 5);
        // send back the targetTaskIdEdit to tasks-table
        $this->emitTo('tasks-table', 'sendBackId', $this->targetTaskIdEdit);
    }

    public function update()
    {
        // $task = TaskModel::findOrFail($this->targetTaskIdEdit);
        // dd($task);
        $category = Task::checkForExistingCategory(trim($this->taskCategory), trim($this->taskDescription));
        if (is_null($category)) {
            // if the category not exists, add the category to the categories table and then update the task
            Task::insertIntoCategories(trim($this->taskCategory), trim($this->taskDescription));
            Task::updateIntoTasks(trim($this->targetTaskIdEdit),trim($this->taskCategory), trim($this->taskDescription));
        } else {
            // if the category exists, just retrive the id from categories table and update it with category_id
            Task::updateIntoTasks(trim($this->targetTaskIdEdit),trim($this->taskCategory), trim($this->taskDescription));
        }
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
        $taskModel->starting_time = $this->startingTimepoint_obj;
        $taskModel->ending_time = $this->endingTimepoint_obj;
        $taskModel->save();
    }

    public function updateIntoTasks($taskId,$category, $description)
    {
        $taskModel = TaskModel::findOrFail($taskId);
        $retrievedCategory = Task::checkForExistingCategory($category, $description);
        $taskModel->category_id = $retrievedCategory->id;
        $taskModel->desired_duration = $this->desiredDuration;
        $taskModel->starting_time = $this->startingTimepoint_obj;
        $taskModel->ending_time = $this->endingTimepoint_obj;
        $taskModel->save();
    }
}
