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
        if ( $this->models !== null && count($this->models)!==0) {
            return DB::table('Models_instanses')->whereIn('id', $this->models)->get();
        } else {
            return [];
        }
        
    }
}
