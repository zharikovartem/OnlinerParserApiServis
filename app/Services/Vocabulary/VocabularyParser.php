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
            $ids = array();
            foreach ($relations as $key => $rusValue) {
                $russianWord = new RussianWord([
                    'name'=>$rusValue,
                    'occurrence'=>null,
                    'languige'=>'rus',
                    'isBasic'=>false,
                    'isContain'=>false
                ]);
                $russianWord->save();

                $ids[] = $russianWord->id;
            }

            # Добавить связи
            if (count($ids) !== 0) {
                $newWord->relations()->attach($ids);
            }
            
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
    }
}

# сбор информации о слове

# Чистка дубликатов русских слов

// 'babla_url' => 'https://www.babla.ru/английский-русский/'.trim( $colls[2]->find('span')[0]->text() ),

// http://translate.google.ru/translate_a/t?client=x&text={jump}&hl=en&sl=en&tl=ru
// %20 - пробел в translate.google строке 

// https://www.translate.ru/dictionary/en-ru/after
// https://www.translate.ru/grammar/en-ru/construct#

