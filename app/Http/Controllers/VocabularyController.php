<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Languige\Vocabylary\userVocabylaryPovit;
use App\Vocabulary;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Services\UniversalParser\UniversalParser;

use App\Models\Languige\EnglishWord;
use App\User;

class VocabularyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->get('user');
        $toLearn = $user->toLearn;
        $vocabylary = $user->vocabylary;

        $toLearnIds = [];
        foreach ($toLearn as $key => $word) {
            $toLearnIds[] = $word->id;
            // $word->$relations;
            $toLearn[$key]->relations;
        }
        $vocabylaryIds = [];
        foreach ($vocabylary as $key => $word) {
            $vocabylaryIds[] = $word->id;
        }

        $newIds = array_merge($toLearnIds, $vocabylaryIds);

        $toLearnCount = count($toLearn);
        // $vocabylaryCount = count($vocabylary);

        $englishWords = EnglishWord::whereNotIn('id', $newIds)
            ->whereNotIn('id', $vocabylaryIds)
            ->limit(25-$toLearnCount)
            ->get();

        if (count($englishWords) !== 0) {
            foreach ($englishWords as $key => $englishWord) {
                $attachItem = [
                    'english_word_id'=>$englishWord->id,
                    'status' => 'toLearn',
                    'progress'=>json_encode( [
                        'tryToLearn'=>0,
                        'successLern'=>0,
                        'errorLern'=>0
                    ] )
                ];
                $user->vocabylary()->attach([$attachItem]);
            }
            $user = User::where('id', $user->id)->get()[0];
            $toLearn = $user->toLearn;
            foreach ($toLearn as $key => $word) {
                $toLearn[$key]->relations;
            }
        }

        return response()->json([
            // "user"=> $user,
            "toLearn"=> $toLearn,
            "vocabylary"=> $vocabylary,
            "englishWords"=>$englishWords
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
        $toLearn = Vocabulary::where('status', 'inProcess')->get();
        $userVocabylaryIds = [];

        # Получаем для User
        $user = $request->get('user');
        $userVocabylary = $user->vocabylary;
        $learned = array();
        $toLearn = array();
        foreach ($userVocabylary as $key => $value) {
            $value->relations;
            $userVocabylaryIds[] = $value->id;
            if ($value->pivot->status === 'learned') {
                $learned[] = $value;
            }
            if ($value->pivot->status === 'toLearn') {
                $toLearn[] = $value;
            }
        }

        # Получаем список английских слов
        $englishWords = EnglishWord::where('id', '>=', $part*100+1)->where('id', '<', $part*100+101)->get();
        foreach ($englishWords as $key => $value) {
            $value->relations;
        }

        return response()->json([
            "vocabularyList"=> $vocabularyList,
            "part"=> $part+1,
            "count"=> $count,
            "toLearn"=> $toLearn,
            "englishWords"=> $englishWords,
            "user"=> $request->get('user'),
            "userVocabylary"=>$userVocabylary,
            "userVocabylaryIds"=>$userVocabylaryIds,

            "learned"=>$learned,
            "toLearn"=>$toLearn,
        ], 200);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EnglishWord  $englishWord
     * @return \Illuminate\Http\Response
     */
    public function checkTestResult(Request $request, EnglishWord  $englishWord)
    {
        # Опредиляем метод проверки:
        $checkMethod = $request->get('checkMethod');
        $status = $request->get('result');

        $user = $request->get('user');
        $user->vocabylary;
        $user->toLearn;
        
        $isNew = true;
        foreach ($user->toLearn as $key => $word) {
            if ($word->id === $englishWord->id) {
                $isNew = false;
                $vocabylaryId = $englishWord->id;

                if ($word->pivot->progress !== null) {
                    // $progress = $word->pivot->progress = json_decode($word->pivot->progress, true);
                    $progress = new UserVocabylaryPovit( json_decode($word->pivot, true) );
                } else {
                    // $progress = [
                    //     'tryToLearn'=>0,
                    //     'successLern'=>0,
                    //     'errorLern'=>0
                    // ];
                    $progress = new UserVocabylaryPovit();
                }
            }
            
        }

        if ($isNew) {
            $attachItem = [
                'english_word_id'=>$englishWord->id,
                'status' => 'toLearn',
                'progress'=>json_encode( [
                    'tryToLearn'=>1,
                    'successLern'=>1,
                    'errorLern'=>0
                ] )
            ];
            $user->vocabylary()->attach([$attachItem]);
            # обновляем User
            $user = User::where('id', $user->id)->get()[0];
            $user->vocabylary;
        } else {
            # UPDATE progress:
            // $result = $this->checkVocabylaryStatus($progress, $status, $checkMethod);
            $progress->editProperty($checkMethod, $status);
            // var_dump($result);
            
            // $user->vocabylary()->updateExistingPivot($vocabylaryId, [
            //     'status' => $progress['successLern'] >= 5 ? 'learned' : 'toLearn',
            //     'progress'=>json_encode($progress)
            // ]);
            $user->vocabylary()->updateExistingPivot($vocabylaryId, $progress->getArray());
        }
        
        $toLearn = $user->toLearn;

        return response()->json([
            "request"=> $request->all(),
            "user"=>$user,
            "englishWord"=>$englishWord,
            "progress"=>isset($progress) ? $progress : null,
            "toLearn"=>$toLearn,
        ], 200);
    }

    /**
     * Проверяет статус слова после изменения параметров
     *
     * @param  UserVocabylaryPovit $progress
     * @param string $status
     * @param string $checkMethod
     * @return UserVocabylaryPovit 
     */
    private function checkVocabylaryStatus(UserVocabylaryPovit  $progress, string $status, string $checkMethod) {
        // $res = [
        //     'status' => '',
        //     'progress'=>'',
        //     'progress_ru_en_c'=>'{}',
        //     'progress_en_ru_c'=>'{}',
        //     'progress_ru_en_s'=>'{}',
        //     'progress_en_ru_s'=>'{}',
        //     'progress_ru_en_r'=>'{}',
        //     'progress_en_ru_r'=>'{}'
        // ];

        // if ($status === 'success') {
        //     $progress->progress->tryToLearn++;
        //     $progress->progress->successLern++;

        //     if ($progress->progress->successLern > $progress->progress->errorLern*2+5) {
        //         // return 'learned';
        //         $res['status'] = 'learned';
        //     } else {
        //         $res['status'] = 'toLearn';
        //     }
            
        // } else {
        //     // $progress->progress->tryToLearn++;
        //     // $progress->progress->errorLern++;

        //     $res['status'] = 'toLearn';
        // }

        // $res['progress'] = json_encode($progress->progress);

        $progress->editProperty($checkMethod, $status);

        // return $res;
        return $progress;
    }

    public function skipWord(Request $request, int $wordId) {
        $user = $request->get('user');
        $targetArray = $user->toLearn;
        $target = null;
        foreach ($targetArray as $value) {
            if ($value->id === $wordId) {
                $target = $value;
            }
        }
        $newPovit = $target->povit;
        $newPovit['status'] = 'learned';
        $user->toLearn()->updateExistingPivot($target->id, $newPovit);

        return response()->json([
            "wordId"=> $wordId,
            "target"=> $target,
        ], 200);
    }
}
