<?php

namespace App\Http\Controllers;

use App\Vocabulary;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Services\UniversalParser\UniversalParser;

class VocabularyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vocabularyList = new Vocabulary( $request->all() );

        return response()->json([
            "vocabularyList"=> $vocabularyList,
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
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function show(Vocabulary $vocabulary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function edit(Vocabulary $vocabulary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vocabulary $vocabulary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vocabulary $vocabulary)
    {
        //
    }

    public function getVocabularyList()
    {
        // echo 'test';
        $count = DB::table('Vocabulary')->count();

        $part = $count/500;
        echo '???'.$part.'???';

        $vocabularyList = UniversalParser::getVocabularyList(4, 1, 500);
        // $parser = new UniversalParser();
        // $vocabularyList = $parser->test();

        return response()->json([
            "vocabularyList"=> $vocabularyList,
        ], 200);
    }
}
