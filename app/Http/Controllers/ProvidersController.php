<?php

namespace App\Http\Controllers;

use App\Providers;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Providers::get();
        return response()->json([
            "providersList"=> $providers,
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
        $newItem = new Providers($request->all());
        $newItem->save();

        return self::index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function show(Providers $providers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function edit(Providers $providers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Providers  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Providers $provider)
    {
        foreach ($request->all() as $field => $value) {
            $provider[$field] = $value;
        }
        $provider->save();
        return self::index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Providers $providers)
    {
        //
    }
}
