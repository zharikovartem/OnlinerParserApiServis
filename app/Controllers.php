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
            // echo $this->name;
            $update = false;

            $childMethods = DB::table('ControllerMethods')->where('controller_id', $this->id)->get();
            $methods = [];
            foreach ($childMethods as $index => $method) {
                $methods[$method->name] = $method->id;
            }

            ############ data ###################
            $request = (object) array(
                "id"=> 0,
                "name"=> "request",
                "type"=> "Request",
                "label"=> "param 1"
            );

            $model = (object) array(
                "id"=> 1,
                "type"=> explode('Controller', $this->name)[0],
                "name"=> lcfirst( explode('Controller', $this->name)[0] ),
                "label"=> "param 2"
            );

            $model2 = (object) array(
                "id"=> 0,
                "type"=> explode('Controller', $this->name)[0],
                "name"=> lcfirst( explode('Controller', $this->name)[0] ),
                "label"=> "param 1"
            );

            
            ####################################

            # index
            if (!isset($methods['index'])) {
                $index = new ControllerMethods([
                    'controller_id'=>$this->id,
                    'name'=>'index',
                    'rest_type'=>'get',
                    'body_actions'=>
                    '"$'.lcfirst( explode('Controller', $this->name)[0] ).' = '.explode('Controller', $this->name)[0].'::get();"',
                    'request'=>json_encode([$request]),
                    'response'=>
                    '"{
                        "type": "Response",
                        "responseItems": [
                            {
                                "key": "'.lcfirst( explode('Controller', $this->name)[0] ).'",
                                "variable": "'.lcfirst( explode('Controller', $this->name)[0] ).'"
                            }
                        ]
                    }"',
                ]);
                $index->save();
                $update = true;
            }
            
            if ( isset($methods['index']) ) {
                $methodId = $methods['index'];
            } else {
                $methodId = $index->id;
            }

            # store
            if (!isset($methods['store'])) {
                $store = new ControllerMethods([
                    'controller_id'=>$this->id,
                    'name'=>'store',
                    'rest_type'=>'post',
                    'body_actions'=>'',
                    'request'=> json_encode([$request, $model]),
                    'response'=> '{
                        "type": "method",
                        "methodId": '.$methodId.',
                        "methodName": "index",
                        "responseItems": []
                    }',
                    'body_actions'=>
                        '   $newItem = new '.explode('Controller', $this->name)[0].'($request->all());
                $newItem->save();',
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
                    'request'=> json_encode([$request, $model]),
                    'body_actions'=>
                        'foreach ($request->all() as $field => $value) {
                            '.lcfirst( explode('Controller', $this->name)[0] ).'[$field] = $value;
                        '.'}
                        '.'$'.lcfirst( explode('Controller', $this->name)[0] ).'->save();',
                    'response'=> '{
                            "type": "method",
                            "methodId": '.$methodId.',
                            "methodName": "index",
                            "responseItems": []
                        }'
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
                    'body_actions'=>'',
                    'request'=> json_encode([$model2]),
                    'response'=> '{
                        "type": "method",
                        "methodId": '.$methodId.',
                        "methodName": "index",
                        "responseItems": []
                    }',
                    'body_actions'=>
                        '   $'.lcfirst( explode('Controller', $this->name)[0] ).'->delete();'
                ]);
                $destroy->save();
                $update = true;
            }

            return $update;
            // return $index;
        }
    }
}
