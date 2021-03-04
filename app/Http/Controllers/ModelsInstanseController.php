<?php

namespace App\Http\Controllers;

use App\ModelsInstanse;
use Illuminate\Http\Request;

class ModelsInstanseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function update(Request $request, ModelsInstanse $modelsInstanse)
    {
        $modelsInstanse2 = ModelsInstanse::where( 'id', $request->get("id") );
        

        // $fields = $request->all();
        // foreach ($fields as $field => $value) {
        //     if (isset($modelsInstanse[$field]) || $modelsInstanse[$field]===null) { 
        //         $modelsInstanse2[$field] = $value;
        //     } else {
        //         $message[$field] = 'do not exist';
        //     }
        // }

        // $modelsInstanse2->save();

        if (!isset($message)) {
            return response()->json([
                'targetModel'=>$modelsInstanse2,
                // 'request'=>$fields,
                // 'modelsInstanse'=>$modelsInstanse
            ], 200);
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

    public function getCurrentModel( $item) {
        // echo '123: '.$item;
        return response()->json([
            "models"=> ModelsInstanse::where('backend_id', $item)
            ->get()
            ], 200);
    }
}
