<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class CategoryColor extends Component
{
    use WithPagination;
    public $targetCategoryId;
    public $categoryColor;
    public $categoryId;
    public $user_id;
    public $category;
    public $categoryDescription;

    public function render()
    {
        return view('livewire.category-color', [
            'allCategories' => DB::table('categories')->select('categories.*')
                ->where('categories.user_id', Auth::user()->id)
                ->paginate(5)
        ]);
    }

    public function edit($id)
    {
        $categories = DB::table('categories')->where('user_id', Auth::user()->id)->where('id', $id)->get()->first();
        // dd($categories);
        // Assign the values from db into sync variables with livewire form
        $this->user_id = $categories->user_id;
        $this->targetCategoryId = $categories->id;
        $this->categoryId = $categories->id;
        $this->category = $categories->category;
        $this->categoryDescription = $categories->description;
        $this->categoryColor = $categories->color;
    }
    public function storeOrUpdate()
    {
        // dd('storeOrUpdate');
        $update = DB::table('categories')
            ->where('user_id', Auth::user()->id)
            ->where('id', $this->categoryId)
            ->update([
                'category' => trim($this->category),
                'description' => trim($this->categoryDescription),
                'color' => $this->categoryColor,
            ]);

        // Refresh the `tasks-table.blade.php`
        $this->emitTo('tasks-table','$refresh');
        if($update){
            session()->flash('successfull_message', 'Category Updated Successfully.');
        }else{
            session()->flash('unsuccessfull_message', 'Updated Was Unsuccessfull.');
        }
        // Clear the livewire variables
        $this->user_id ='';
        $this->targetCategoryId ='';
        $this->categoryId ='';
        $this->category ='';
        $this->categoryDescription ='';
        $this->categoryColor ='';
        // Send a message that the record has been updated.
    }
}
