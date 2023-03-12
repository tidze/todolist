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
    public $inputValue;
    public $deleteId;

    // protected $listeners = ['deleteTask'];

    public function mount()
    {
        $this->endingTimepoint_obj = '';
        $this->startingTimepoint_obj = '';
        $this->desiredDuration = '';
        $this->taskCategory = '';
        $this->taskDescription = '';
    }

    public function render()
    {
        return view('livewire.task');
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function deleteTask($id)
    {
        TaskModel::findOrFail($id)->delete();
        // TaskModel::findOrFail($this->deleteId)->delete();
        // dd($targetTask);
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
}
