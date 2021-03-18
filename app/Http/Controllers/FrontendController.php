<?php

namespace App\Http\Controllers;

use App\ControllerMethods;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //...
    /**
    * Descriptions
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $frontend = Frontend::get();

        return response()->json([
            "frontend"=> $frontend,
        ], 200);
    }


    /**
    * Descriptions
    * @param \Illuminate\Http\Request $request
    * @param \Illuminate\Http\Frontend $frontend
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, Frontend $frontend)
    {

        $newItem = new Frontend($request->all());
                $newItem->save();
        return self::index();
    }


    /**
    * Descriptions
    * @param \Illuminate\Http\Request $request
    * @param \Illuminate\Http\Frontend $frontend
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Frontend $frontend)
    {
        $fields = $request->all();
        foreach ( $fields as $field => $value) {
            $frontend[$field] = $value;
        }

        $frontend->save();
        return self::index();
    }
    /**
    * Descriptions
    * @param \Illuminate\Http\Frontend $frontend
    * @return \Illuminate\Http\Response
    */
    public function destroy(Frontend $frontend)
    {
        $frontend->delete();
        return self::index();
    }
}