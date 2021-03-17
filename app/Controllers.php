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
            $update = false;

            $childMethods = DB::table('ControllerMethods')->where('controller_id', $this->id)->get();
            $methods = [];
            foreach ($childMethods as $index => $method) {
                $methods[$method->name] = $method->name;
            }

            # index
            if (!isset($methods['index'])) {
                $index = new ControllerMethods([
                    'controller_id'=>$this->id,
                    'name'=>'index',
                    'rest_type'=>'get',
                    'body_actions'=>'{}',
                ]);
                $index->save();
                $update = true;
            }
            
            # store
            if (!isset($methods['store'])) {
                $store = new ControllerMethods([
                    'controller_id'=>$this->id,
                    'name'=>'store',
                    'rest_type'=>'post',
                    'body_actions'=>'{}',
                ]);
                $store->save();
                $update = true;
            }

            # update
            if (!isset($methods['update'])) {
                $update = new ControllerMethods([
                    'controller_id'=>$this->id,
                    'name'=>'update',
                    'rest_type'=>'put',
                    'body_actions'=>'{}',
                ]);
                $update->save();
                $update = true;
            }

            # destroy
            if (!isset($methods['destroy'])) {
                $destroy = new ControllerMethods([
                    'controller_id'=>$this->id,
                    'name'=>'destroy',
                    'rest_type'=>'delete',
                    'body_actions'=>'{}',
                ]);
                $destroy->save();
                $update = true;
            }

            return $update;
        }
    }
}
