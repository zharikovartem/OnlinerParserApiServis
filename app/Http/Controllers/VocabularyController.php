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
        $count = DB::table('Vocabulary')->count();

        $part = $count % 500;
        $ost = $part % 100;
        echo $ost;
        $page = $part / 100 - ($ost/100);

        $index = ($count-$part) / 500;

        $start = $index*500+1;
        $stop = $index*500+500;

        // $vocabularyList = 'https://audio-english.ru/frequencydict/s_'.$start.'_po_'.$stop.'/page-'. $page .'/';
        // // $document = new Document($base, true);
        // echo $vocabularyList;

        $vocabularyList = UniversalParser::getVocabularyList($page, $start, $stop);
        // $parser = new UniversalParser();
        // $vocabularyList = $parser->test();

        return response()->json([
            "vocabularyList"=> $vocabularyList,
            "index"=> $index,
            "count"=> $count,
            "part"=> $part,
            "page"=> $page,
            "start"=> $start,
            "stop"=> $stop,
            "ost"=> $ost,
        ], 200);
    }

    // public function getVocabularyPart($part)
    // {
    //     $part--;
    //     $count= Vocabulary::count();

    //     $vocabularyList = Vocabulary::where('id', '>=', $part*100+1)->where('id', '<', $part*100+101)->get();

    //     return response()->json([
    //         "vocabularyList"=> $vocabularyList,
    //         "part"=> $part+1,
    //         "count"=> $count,
    //         // "part"=> $part,
    //         // "page"=> $page,
    //         // "start"=> $start,
    //         // "stop"=> $stop,
    //     ], 200);
    // }


    
    private function getVocabularyPart($part)
    {
        $arrayData = [
            ['address' => 'г. Минск, ул. Восточнаяя, д. 33', 'date_from' => '31-12-2002', 'date_to' => '31-12-2005'],
            ['address' => 'г. Минск, ул. Восточнаяя, д. 34', 'date_from' => '31-12-2005', 'date_to' => '31-12-2006'],
            ['address' => 'г. Минск, ул. Восточнаяя, д. 34', 'date_from' => '31-12-2006', 'date_to' => '31-12-2008'],
            ['address' => 'г. Минск, ул. Тихая, д. 33', 'date_from' => '31-12-2000', 'date_to' => '31-12-2002'],
            ['address' => 'г. Минск, ул. Ленина, д. 33', 'date_from' => '31-12-2008', 'date_to' => '31-12-2010'],
            ['address' => 'г. Минск, ул. Ленина, д. 33', 'date_from' => '31-12-2010', 'date_to' => '31-12-2011'],
            ['address' => 'г. Минск, ул. Тихая, д. 33', 'date_from' => '31-12-2012'],
            ['address' => 'г. Минск, ул. Ленина, д. 33', 'date_from' => '31-12-2011', 'date_to' => '31-12-2012'],
        ];

        function my_comparison($a, $b) {
            return strcmp($a['date_from'], $b['date_from']);
        }

        usort($arrayData, 'my_comparison');

        var_dump($data);

        foreach ($array as $key =>  list($address, $date_from, $date_to)) {
            $ressult .= $date_from.'/'.$date_to.': '.$address.';';
        }  
        echo $ressult;
    }
}
