<?php

namespace App\Http\Controllers\Api\Parser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\CatalogParsingJob;
use App\Models\Catalog;
// use Carbon\Carbon;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Catalog::get(), 200);
        // return 'Вывод всех товарных групп';
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function startCatalogParsing()
    {
        // $item = Catalog::create(
        //     [
        //         'name'=>'startCatalogParsing',
        //         'parent_id'=>'0',
        //         'label'=>'startCatalogParsing',
        //         'labels'=>'startCatalogParsing'
        //     ]
        // );


        // $job = new CatalogParsingJob($item);
        //         //    ->delay(Carbon::now()->addMinutes(1));
        // // dd($job);
        // $this->dispatch($job);
        // return ' event запущен';

        // $job = new CatalogParsingJob();
        dispatch(new CatalogParsingJob);
        // $this->dispatch(new CatalogParsingJob);
        return ' event запущен';
    }
}
