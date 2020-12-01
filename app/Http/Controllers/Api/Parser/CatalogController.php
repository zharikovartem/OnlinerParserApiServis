<?php

namespace App\Http\Controllers\Api\Parser;

use App\Services\Parsers\OnlinerParser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\CatalogParsingJob;
use App\Jobs\CatalogItemParsingJob;
use App\Jobs\ProductParamParsingJob;
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
        dispatch(new CatalogParsingJob);
        return response()->json(['status'=>'started', 'message'=>'Event запущен'], 200);
    }

    public function startCatalogItem($productType)
    {
        $urlToParse = Catalog::where('name', $productType)->first();

        dispatch(new CatalogItemParsingJob([
            'name'=>$productType,
            'part'=>1,
            'url'=>$urlToParse['url']
        ]));
        return 'parse catalog item';
    }

    public function startProductParamParsing($productType) 
    {
        $productBase = Catalog::where('name', $productType)->first();
        // dd($productBase);
        
        dispatch(new ProductParamParsingJob([
            // $productBase
            'name'=>$productType,
            'part'=>1,
            'getParams'=>true,
            'repeat'=>true,
            'item'=>false,
            'target'=>null
        ]));
        return 'startProductParamParsing';
    }

    public function startProductParamItem($productType, $productId) {

        $productBase = Catalog::where('name', $productType)->first();

        // dispatch(new ProductParamParsingJob([
        //     // $productBase
        //     'name'=>$productType,
        //     'part'=>1,
        //     'getParams'=>false,
        //     'repeat'=>false,
        //     'item'=>true,
        //     'target'=>$productId
        // ]));



        return OnlinerParser::getProductParams(
            [
                'name'=>$productType,
                'part'=>1,
                'getParams'=>false,
                'repeat'=>false,
                'item'=>true,
                'target'=>$productId
            ]
        );
    }
}
