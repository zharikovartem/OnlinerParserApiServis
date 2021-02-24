<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'name', 
        'user_id', 
        'date',
        'action',
        'action_data',
    ];

    // protected $attributes = ['delayed' => false,]; // Значения по умолчанию

    
}
