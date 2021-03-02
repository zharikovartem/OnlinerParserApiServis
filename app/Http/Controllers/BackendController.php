<?php

namespace App\Http\Controllers;

use App\Backend;
use Illuminate\Http\Request;

class BackendController extends Controller
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
     * @param  \App\Backend  $backend
     * @return \Illuminate\Http\Response
     */
    public function show(Backend $backend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Backend  $backend
     * @return \Illuminate\Http\Response
     */
    public function edit(Backend $backend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Backend  $backend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Backend $backend)
    {
        $fields = $request->all();
        foreach ($fields as $field => $value) {
            if (isset($backend[$field]) || $backend[$field]===null) { 
                $backend[$field] = $value;
            } else {
                $message[$field] = 'do not exist';
            }
        }
        $backend->save();
        if (!isset($message)) {
            return response()->json([
                $backend,
            ], 200);
            // $request = new Request;
            // $request->request->add([ 'date' => $task['date'] ]);

            // return self::index($request);
        } else {
            return response()->json(['error'=>true, 'message'=>$message], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Backend  $backend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Backend $backend)
    {
        //
    }

    public function getNeedBackends( $item) {
        // echo '123: '.$item;
        return response()->json([
            "Backend"=> Backend::where('id', $item)
            ->get()
            ], 200);
    }
}
