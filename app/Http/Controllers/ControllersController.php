<?php

namespace App\Http\Controllers;

use App\Controllers;
use Illuminate\Http\Request;

class ControllersController extends Controller
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
     * @param  \App\Controllers  $controllers
     * @return \Illuminate\Http\Response
     */
    public function show(Controllers $controllers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Controllers  $controllers
     * @return \Illuminate\Http\Response
     */
    public function edit(Controllers $controllers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Controllers  $controllers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Controllers $controllers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Controllers  $controllers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Controllers $controllers)
    {
        //
    }

    public function getCurrentControllers($item) {
        // echo '123: '.$item;
        $controllers = Controllers::where('backend_id', $item)->get();

        foreach ($controllers as $key => $controller) {
            $controllers[$key]['models'] = $controller->getModel();
        }

        return response()->json([
            "controllers"=> $controllers
            ], 200);
    }
}
