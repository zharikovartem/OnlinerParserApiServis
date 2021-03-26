<?php

namespace App\Services\Vocabulary;

use DiDom\Document;
use app\Models\Languige\EnglishWord;
use app\Models\Languige\RussianWord;

class VocabularyParser
{
    private $url;

    public function __construct(int $start, int $stop, int $part)
    {
        $this->url = 'https://audio-english.ru/frequencydict/s_'.$start.'_po_'.$stop.'/page-'.$part.'/';
    }

    public function getVocabularyList()
    {
        
        $document = new Document($this->url, true);
        $table = $document->find('.table-voc');
        foreach ($table[0]->find('tr') as $i => $row) {
            $colls = $row->find('td');

            $name = trim( $colls[2]->find('span')[0]->text() );
            $relations = explode(', ', trim( $colls[4]->text() )) ;
            $occurrence = trim( $colls[6]->text() );
            $description = trim( $colls[7]->text() );

            $obj = [
                'name'=>$name,
                'relations'=>$relations,
                'occurrence'=>$occurrence,
                'description'=>$description
            ];

            var_dump($obj);
            echo '<br/><br/>';
        }

        // EnglishWord::create([
        //     'name'=>$name,
        //     'occurrence'=>$occurrence,
        //     'description'=>$description
        // ]);

        $englishWord = new EnglishWord([
                'name'=>$name,
                'occurrence'=>$occurrence,
                'description'=>$description
            ]);

            $englishWord->save();
        
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

