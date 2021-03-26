<?php

namespace App\Services\Vocabulary;

use DiDom\Document;
use App\Models\Languige\EnglishWord;
use App\Models\Languige\RussianWord;
use App\Jobs\VocabularyParsingJob;

class VocabularyParser
{
    private $url;
    private $start;
    private $stop;
    private $part;

    public function __construct(int $start, int $stop, int $part)
    {
        $this->start = $start;
        $this->stop = $stop;
        $this->part = $part;

        $this->url = 'https://audio-english.ru/frequencydict/s_'.$start.'_po_'.$stop.'/page-'.$part.'/';
    }

    public function getVocabularyList()
    {
        
        $document = new Document($this->url, true);
        $table = $document->find('.table-voc');

        $count = 0;
        foreach ($table[0]->find('tr') as $i => $row) {
            $colls = $row->find('td');

            $name = trim($colls[2]->find('span')[0]->text());
            $occurrence = trim($colls[6]->text());
            $description = trim($colls[7]->text());

            $relations = explode(', ', trim( $colls[4]->text() ));

            $newWord = new EnglishWord([
                'name'=>$name,
                'occurrence'=>$occurrence,
                'description'=>$description,
                'languige'=>'eng',
                'isBasic'=>true,
                'isContain'=>false
            ]);
            $newWord->save();

            $count++;
            # Добавиить русские слова
            foreach ($relations as $key => $rusValue) {
                $russianWord = new RussianWord([
                    'name'=>$rusValue,
                    'occurrence'=>null,
                    'languige'=>'rus',
                    'isBasic'=>false,
                    'isContain'=>false
                ]);
                $russianWord->save();
                $russianWordsArray[] = $russianWord;
            }

            # Добавить связи
            $newWord->relations()->attach($russianWordsArray);
        }

        if ($count !== 0) {
            if ($this->part !== 4) {
                dispatch( (new VocabularyParsingJob($this->start ,$this->stop, $this->part+1)) );
            } else {
                $start = $this->start+500;
                $stop = $this->stop+500;
                dispatch( (new VocabularyParsingJob($start ,$stop, 0)) );
            }
        }
        

        

        // EnglishWord::create([
        //     'name'=>$name,
        //     'occurrence'=>$occurrence,
        //     'description'=>$description
        // ]);

        // $englishWord = new EnglishWord([
        //         'name'=>$name,
        //         'occurrence'=>$occurrence,
        //         'description'=>$description,
        //         'languige'=>'eng'
        //     ]);
        // // $englishWord = new EnglishWord($name, $occurrence, $description);

        // $englishWord->save();
        
        // 1. Список обьектов для заполнения
            // 1.1 EnglishWord
            // 1.2 RussianWord
            // 1.3 englis_russian
        // 2. Получить список EnglishWord (name, descriptions, yandex_url, babla_url)
    }
}

// 'babla_url' => 'https://www.babla.ru/английский-русский/'.trim( $colls[2]->find('span')[0]->text() ),

// http://translate.google.ru/translate_a/t?client=x&text={jump}&hl=en&sl=en&tl=ru
// %20 - пробел в translate.google строке 

// https://www.translate.ru/dictionary/en-ru/after
// https://www.translate.ru/grammar/en-ru/construct#

