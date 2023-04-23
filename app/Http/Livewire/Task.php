<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Task as TaskModel;
use App\Models\Category as CategoryModel;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Task extends Component
{
    protected $layout = null;

    public $taskCategory;
    public $taskDescription;
    public $desiredDuration;
    public $startingTimepoint_unix;
    public $endingTimepoint_unix;
    // when does your "task" starts and when does it ends?
    public $startingTimepoint;
    public $endingTimepoint;
    // when does your "day" starts and when does it ends? task history : today , yesterday or from 4 days ago till now
    public $startingDatepoint;
    public $endingDatepoint;
    public $targetTaskIdEdit;
    // detector for whether it should be update or store fucntion (any parameter that contains 9, store has been choosen)
    public $detector;
    public $timezone;
    // since we're calling editTask from tasks-table component's controller we need to register our function controller
    protected $listeners = ['editTask'];

    public function mount()
    {
        $this->endingTimepoint_unix = time();
        $this->startingTimepoint_unix = time();
        // the starting time for "clock time picker" ought to be current time. for now we leave it at 00:00
        $this->startingTimepoint = '00:00';
        $this->endingTimepoint = '00:00';
        $this->desiredDuration = '';
        $this->taskCategory = '';
        $this->taskDescription = '';
        // $this->timezone =  new DateTimeZone();
        // session_start(); $timezone = $_SESSION['time'];
    }

    public function render()
    {
        return view('livewire.task', [
            'allCategories' => DB::table('categories')
                ->select('categories.category', 'categories.description', 'categories.color')
                ->where('user_id', Auth::user()->id)
                ->orderByDesc('id')
                ->get()
                ->toArray(),
            'category_Distinct' => DB::table('categories')->where('user_id', Auth::user()->id)->distinct()->select('category')->get(),
        ]);
    }

    // incoming request from tasks-table anchor tag
    public function editTask($id)
    {
        $this->targetTaskIdEdit = $id;
        $task = DB::table('tasks')->select('tasks.*', 'categories.category', 'categories.description', 'categories.color')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->where('tasks.user_id', Auth::user()->id)
            ->where('tasks.id', $id)
            ->first();
        $this->taskCategory = $task->category;
        $this->taskDescription = $task->description;
        $this->desiredDuration = $task->desired_duration;
        // turn it into each time zone , this fix is temporary
        $this->startingTimepoint_unix = $task->starting_time * 1000;
        $this->endingTimepoint_unix = $task->ending_time * 1000;
        $this->startingTimepoint =  date("H:i", $task->starting_time + 12600);
        $this->endingTimepoint = date("H:i", $task->ending_time + 12600);
        $this->startingDatepoint =  date("Y-m-d", $task->starting_time + 12600);
        $this->endingDatepoint = date("Y-m-d", $task->ending_time + 12600);
        // send back the targetTaskIdEdit to tasks-table
        // $this->emitTo('tasks-table', 'sendBackId', $this->targetTaskIdEdit);
        $this->emitTo('custom-chart','$refresh');

    }

    public function update()
    {
        $validatedData = Validator::make(
            [
                'targetTaskIdEdit' => $this->targetTaskIdEdit,
                'startingTimepoint_unix' => $this->startingTimepoint_unix,
                'endingTimepoint_unix' => $this->endingTimepoint_unix,
                'desiredDuration' => $this->desiredDuration,
                'taskCategory' => $this->taskCategory,
                'taskDescription' => $this->taskDescription,
            ],
            [
                'targetTaskIdEdit' => ['required'],
                'startingTimepoint_unix' => ['required'],
                'endingTimepoint_unix' => ['required'],
                'desiredDuration' => ['required'],
                'taskCategory' => ['required'],
                'taskDescription' => ['required'],
            ]
        );

        // dd($validatedData);
        if ($validatedData->fails()) {
            session()->flash('update_validator_fail', 'Please provide requested inputs for update');
        } else {
            // session()->flash('store_validator_success', 'store_validator_success');
        }
        $validatedData->validate();


        $category = $this->checkForExistingCategory(Auth::user()->id, trim($this->taskCategory), trim($this->taskDescription));
        if (is_null($category)) {
            // if the category not exists, add the category to the categories table and then update the task
            $this->insertIntoCategories(Auth::user()->id, trim($this->taskCategory), trim($this->taskDescription));
            $this->updateIntoTasks(trim($this->targetTaskIdEdit), trim($this->taskCategory), trim($this->taskDescription));
        } else {
            // if the category exists, just retrive the id from categories table and update it with category_id
            $this->updateIntoTasks(trim($this->targetTaskIdEdit), trim($this->taskCategory), trim($this->taskDescription));
        }
        $this->resetErrorBag();

        $this->resetValidation();

        $this->emitTo('custom-chart','getTask');
    }

    public function deleteTask($id)
    {
        TaskModel::findOrFail($id)->delete();
    }

    public function store()
    {
        $validatedData  = Validator::make(
            [
                'startingTimepoint_unix' => $this->startingTimepoint_unix,
                'endingTimepoint_unix' => $this->endingTimepoint_unix,
                'desiredDuration' => $this->desiredDuration,
                'taskCategory' => $this->taskCategory,
                'taskDescription' => $this->taskDescription,
            ],
            [
                'startingTimepoint_unix' => ['required'],
                'endingTimepoint_unix' => ['required'],
                'desiredDuration' => ['required'],
                'taskCategory' => ['required'],
                'taskDescription' => ['required'],
            ]
        );

        // dd($validatedData);
        if ($validatedData->fails()) {
            session()->flash('store_validator_fail', 'Please provide requested inputs for store');
        } else {
            // session()->flash('store_validator_success', 'store_validator_success');
        }
        $validatedData->validate();

        $category = $this->checkForExistingCategory(Auth::user()->id, trim($this->taskCategory), trim($this->taskDescription));
        if (is_null($category)) {
            // if the category does not exist, add the category to the categories table and then add the task
            $this->insertIntoCategories(Auth::user()->id, trim($this->taskCategory), trim($this->taskDescription));
            $this->insertIntoTasks(Auth::user()->id, trim($this->taskCategory), trim($this->taskDescription));
        } else {
            // if the category exists, just retrive the id from categories table and insert it as category_id
            $this->insertIntoTasks(Auth::user()->id, trim($this->taskCategory), trim($this->taskDescription));
        }
        $this->emitTo('tasks-table', '$refresh');
        $this->taskCategory = '';
        $this->taskDescription = '';
        $this->desiredDuration = '';
        $this->startingTimepoint_unix = '';
        $this->endingTimepoint_unix = '';
        $this->startingTimepoint = '00:00';
        $this->endingTimepoint = '00:00';
        $this->targetTaskIdEdit = '';
        $this->emitTo('tasks-table', 'sendBackId', $this->targetTaskIdEdit);
        $this->emitTo('category-color', '$refresh');
        $this->emitTo('custom-chart','getTask');

        $this->resetErrorBag();
    }

    public function checkForExistingCategory($user_id, $category, $description)
    {
        return CategoryModel::where('user_id', $user_id)->where('category', $category)->where('description', $description)->first();
    }

    public function insertIntoCategories($user_id, $category, $description)
    {
        $categoryModel = new CategoryModel;
        $categoryModel->user_id = $user_id;
        $categoryModel->category = $category;
        $categoryModel->description = $description;
        $categoryModel->save();
    }

    public function insertIntoTasks($user_id, $category, $description)
    {
        $taskModel = new TaskModel;
        $retrievedCategory = $this->checkForExistingCategory(Auth::user()->id, $category, $description);
        $taskModel->user_id = $user_id;
        $taskModel->category_id = $retrievedCategory->id;
        $taskModel->desired_duration = $this->desiredDuration;
        // The UnixEpoch in js is in miliseconds, while php is in seconds.
        $taskModel->starting_time = substr($this->startingTimepoint_unix, 0, 10);
        $taskModel->ending_time = substr($this->endingTimepoint_unix, 0, 10);
        $taskModel->save();
        if ($taskModel) {
            session()->flash('successfull_message', 'Task Added Successfully');
        } else {
            session()->flash('unsuccessfull_message', 'Adding Task Was Unsuccessfull');
        }
    }

    public function updateIntoTasks($taskId, $category, $description)
    {
        $retrievedCategory = $this->checkForExistingCategory(Auth::user()->id, $category, $description);
        $update = DB::table('tasks')->where('id', $taskId)
            ->update([
                'category_id' => $retrievedCategory->id,
                'desired_duration' => $this->desiredDuration,
                'starting_time' => substr($this->startingTimepoint_unix, 0, 10),
                'ending_time' => substr($this->endingTimepoint_unix, 0, 10),
            ]);
        if ($update) {
            session()->flash('successfull_message', 'Task Updated Successfully');
        } else {
            session()->flash('unsuccessfull_message', 'Updating Task Was Unsuccessfull');
        }
        $this->emitTo('tasks-table', '$refresh');
        $this->taskCategory = '';
        $this->taskDescription = '';
        $this->desiredDuration = '';
        $this->startingTimepoint_unix = '';
        $this->endingTimepoint_unix = '';
        $this->startingTimepoint = '00:00';
        $this->endingTimepoint = '00:00';
        $this->targetTaskIdEdit = '';
    }
}
