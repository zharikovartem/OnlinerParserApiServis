<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Controllers extends Model
{
    use SoftDeletes;

    protected $table = 'controllers';

    protected $fillable = [
        'name', 
        'backend_id',
        'model_id',
        'folder'
    ];

    public function getModel() {
        if ( isset($this->model_id) && $this->model_id !== null) {
            return DB::table('Models_instanses')->whereIn('id', $this->models)->get();
        } else {
            return [];
        }
        
    }
}
