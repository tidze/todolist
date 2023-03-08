<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

// use App\Models\Category;
// HasOne

class Task extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_id',
        'desired_duration',
        'starting_time',
        'ending_time',
    ];

    public function task():HasOne
    {
        return $this->hasOne(Category::class,'id');
        // return $this->hasOne(User::class,'id');
    }
}
