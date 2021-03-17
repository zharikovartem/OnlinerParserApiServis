<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

use App\ControllerMethods;

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
        if ( $this->models !== null 
        // && count($this->models)!==0
        ) {
            $models = json_decode($this->models, true);
            return DB::table('Models_instanses')->whereIn('id', $models)->get();
        } else {
            return [];
        }
    }

    public function checkIsResurce()
    {
        if ( $this->isResource ) {
            // echo 'isResource: controller-Id: '.$this->id;

            # index
            $index = new ControllerMethods([
                'controller_id'=>$this->id,
                'name'=>'newIndex',
                'rest_type'=>'post',
                'body_actions'=>'{}'
            ]);
            $index->save();
            
            # store
            # update
            # destroy
        }
    }
}
