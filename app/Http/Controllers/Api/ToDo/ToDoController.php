<?php

namespace App\Http\Controllers\Api\ToDo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\ToDo;

class ToDoController extends Controller
{
    private function makeTreeData($arr, $parent_id) {
        $resp = array();
        $pp = 0;
        $childsArr = array();
        # формируем массив 
        foreach ($arr as $key => $value) {
            if ( $value->parent_id === $parent_id ) {
                $resp[] = [
                    'title'=>$value->name,
                    'key'=>$pp,
                    'children'=>array(),
                    'id'=>$value->id,
                ];
                $pp++;
            } else {
                // $childsArr[$value->id][] = $arr[$key];
                $childsArr[]= $arr[$key];
            }
        }

        // dd($childsArr);

        # Добавляем children
        if (count($childsArr) > 0) {
            foreach ($resp as $key => $value) {
                foreach ($childsArr as $keyC => $valueC) {
                    // var_dump($value);
                    if ($valueC->parent_id === $value['id']) {
                        // echo '!!!!!!!!!!'.$value['id'].'<br/>';
                        $resp[$key]['children'] = self::makeTreeData($childsArr, $value['id']);
                    }
                }
            }
        }

        return $resp;
    }

    public function getToDoList() {
        #Получить весь список задач
        $ToDoList = DB::table('ToDo')->get();


        return response()->json([
            'ToDoList'=> self::makeTreeData($ToDoList, 0),
            ], 200);
    }

    public function editToDoItem($data) {
        return response()->json([
            'newData'=> $data,
            ], 200);
    }

    public function createNewTask(Request  $data) {
        // var_dump($data);
        // DB::table('ToDo')->insert($data);
        if (!$data['parent_id']) {
            $parent_id = 0;
        } else {
            $parent_id = $data['parent_id'];
        }
        DB::table('ToDo')->insert(
            [
                'name'=> $data['name'],
                'description'=> $data['description'],
                'parent_id'=> $parent_id,
            ]
        );

        // return response()->json([
        //     'data'=> $data['name'],
        //     ], 200);

        return self::getToDoList();
    }
}
