<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function relatedModels()
    {
        return $this->hasOne(Category::class);
    }
}
