<?php

namespace App\Http\Controllers;

use App\ControllerMethods;
use Illuminate\Http\Request;

class ControllerMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "controllerMethods"=> ControllerMethods::get()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ControllerMethods  $controllerMethods
     * @return \Illuminate\Http\Response
     */
    public function show(ControllerMethods $controllerMethods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ControllerMethods  $controllerMethods
     * @return \Illuminate\Http\Response
     */
    public function edit(ControllerMethods $controllerMethods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ControllerMethods  $controllerMethods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ControllerMethods $controllerMethods)
    {
        $fields = $request->all();

        // foreach ($fields as $field => $value) {
            // $controllerMethods[$field] = $value;
        // }

        // $controllerMethods->save();

        return response()->json([
            "controllerMethods"=>$controllerMethods,
            "request"=>$fields
            ], 200);

        // return self::index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ControllerMethods  $controllerMethods
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControllerMethods $controllerMethods)
    {
        //
    }
}
