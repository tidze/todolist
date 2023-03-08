<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task as TaskModel;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Facades\DB;

class Task extends Controller
{
    public function index(Request $request)
    {
        $allTasks = Task::retriveAllTasks();
        // $allTasks = CategoryModel::all();
        // dd($allTasks);
        return view('welcome')->with('allTasks', $allTasks);

    }

    public function getTasks()
    {
        dd('getTasks()');
    }

    public function retriveAllTasks()
    {
        // ---------**************-------- it seems like laravel has default selector for id ...
        // so when you don't define the select statement to get the id, it overrides them for itself and fucks with your join statement
        return TaskModel::select('tasks.*','categories.category','categories.description')->join('categories','tasks.category_id','=','categories.id')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'taskCategory'=>['required'],
            'taskDescription'=>['required'],
        ]);
        
        $category = Task::checkForExistingCategory($request->input('taskCategory'), $request->input('taskDescription'));
        if (is_null($category)) {
            // if the category not exists, add the category to the categories table and then add the task
            Task::insertIntoCategories($request->input('taskCategory'), $request->input('taskDescription'));
            Task::insertIntoTasks($request, $request->input('taskCategory'), $request->input('taskDescription'));
        } else {
            // if the category exists, just retrive the id from categories table and insert it as category_id
            Task::insertIntoTasks($request, $category->category, $category->description);
        }
        // return redirect('/');
        return redirect()->back();
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

    public function insertIntoTasks(Request $request, $category, $description)
    {
        $taskModel = new TaskModel;
        $retrievedCategory = Task::checkForExistingCategory($category, $description);
        $taskModel->category_id = $retrievedCategory->id;
        $taskModel->desired_duration = $request->input('desiredDuration');
        $taskModel->starting_time = $request->input('startingTimepoint_obj');
        $taskModel->ending_time = $request->input('endingTimepoint_obj');
        $taskModel->save();
    }
}
