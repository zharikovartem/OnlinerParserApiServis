<?php

namespace App\Http\Controllers;

use App\Vocabulary;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Services\UniversalParser\UniversalParser;

use App\Models\Languige\EnglishWord;

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

        $englishWord = '';

        return response()->json([
            "vocabularyList"=> $vocabularyList,
            "EnglishWord"=> $englishWord
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
        foreach ($request->all() as $field => $value) {
            $vocabulary[$field] = $value;
        }
        $vocabulary->save();
        // return self::index();
        return response()->json([
            "vocabularyTarget"=> $vocabulary,
        ], 200);
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

    public function getVocabularyPart(Request $request, int $part)
    {
        $part--;
        $count= Vocabulary::count();

        $vocabularyList = Vocabulary::where('id', '>=', $part*100+1)->where('id', '<', $part*100+101)->get();

        $toLern = Vocabulary::where('status', 'inProcess')->get();

        # Получаем для User
        $user = $request->get('user');
        $userVocabylary = $user->vocabylary;
        // $userVocabylaryIds = array_column( (array)$userVocabylary, 'id');
        $userVocabylaryIds = array_filter( (array)$userVocabylary, function ($item) { 
            return $item; 
        } );
        // $userVocabylaryIds = array_map(function ( $item) { 
        //     // var_dump($item);
        //     // return $item->id;
        //     return $item;
        //  }, (array) $userVocabylary );

        # Получаем список английских слов
        $englishWords = EnglishWord::where('id', '>=', $part*100+1)->where('id', '<', $part*100+101)->get();
        foreach ($englishWords as $key => $englishWord) {
            // if (!isset($userVocabylaryIds[$englishWord['id']])) {
                $check[] = $englishWords[$key]->relations;
            // }
        }

        

        

        return response()->json([
            "vocabularyList"=> $vocabularyList,
            "part"=> $part+1,
            "count"=> $count,
            "toLern"=> $toLern,
            "englishWords"=> $englishWords,
            "check"=> $check,
            "user"=> $request->get('user'),
            "userVocabylary"=>$userVocabylary,
            "userVocabylaryIds"=>$userVocabylaryIds
        ], 200);
    }
}
