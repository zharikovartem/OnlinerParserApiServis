<?php

namespace App\Http\Controllers;

use App\ModelsInstanse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModelsInstanseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "index"=>'index',
            "Tasks"=> ModelsInstanse::get()
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newModel = new ModelsInstanse($request->all());
        $newModel->save();
        return self::getCurrentModel($request->get("backend_id"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsInstanse  $modelsInstanse
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsInstanse $modelsInstanse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelsInstanse  $modelsInstanse
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsInstanse $modelsInstanse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsInstanse  $modelsInstanse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelsInstanse $modelsInstanse) {
        $targetId = $request->get("id");

        $target2 = ModelsInstanse::where( 'id', $targetId )->get();
        

        $fields = $request->all();

        foreach ($fields as $field => $value) {
            if (isset($modelsInstanse[$field]) || $modelsInstanse[$field]===null) { 
                $target2[0][$field] = $value;
            } else {
                $message[$field] = 'do not exist';
            }
        }

        $target2[0]->save();

        if (!isset($message)) {
            // return response()->json([
            //     'target'=>$target,
            //     'target2'=>$target2,
            //     'id'=>$request->get("id"),
            //     'request'=>$fields,
            //     'modelsInstanse'=>$modelsInstanse
            // ], 200);
            return self::getCurrentModel($request->get("backend_id"));
        } else {
            return response()->json(['error'=>true, 'message'=>$message], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsInstanse  $modelsInstanse
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsInstanse $modelsInstanse)
    {
        //
    }

    public function getCurrentModel($item) {
        // echo '123: '.$item;
        return response()->json([
            "models"=> ModelsInstanse::where('backend_id', $item)
            ->get()
            ], 200);
    }
}
