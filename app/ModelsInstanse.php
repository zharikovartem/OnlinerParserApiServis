<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelsInstanse extends Model
{
    use SoftDeletes;

    // protected $table = 'ModelsInstanse';
    protected $table = 'Models_instanses';

    protected $fillable = [
        'name', 
        'backend_id',
        'folder'
    ];
}
