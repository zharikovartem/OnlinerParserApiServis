<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use SoftDeletes;
    
    protected $table = 'Task';
}
