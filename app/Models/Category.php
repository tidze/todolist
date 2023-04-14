<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category',
        'color',
    ];
    protected $nullable = [
        'description',
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

}
