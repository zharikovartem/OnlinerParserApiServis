<?php

namespace App\Services\UniversalParser;

use DiDom\Document;
use App\Vocabulary;
use App\Services\UniversalParser\Yandex_Translate;

class UniversalParser {

    public static function getVocabularyList($page, $start, $stop) 
    {
        $base = 'https://audio-english.ru/frequencydict/s_1_po_500/page-0/';
        // $base = 'https://audio-english.ru/frequencydict/s_'.$start.'_po_'.$stop.'/page-'.$page.'/';
        $document = new Document($base, true);

        $table = $document->find('.table-voc');

        foreach ($table[0]->find('tr') as $i => $row) {
            $colls = $row->find('td');

            $response = 'no result';

            echo trim($colls[0]->html()).'->';
            echo trim($colls[2]->find('span')[0]->html()); 
            echo '='.trim($colls[4]->html()).'('.trim($colls[6]->html()).')';

            $yandex_url = explode('ru-en', $colls[5]->find('a')[0]->href).'en-ru' ; 


            echo '<br/>';
            $item = new Vocabulary([
                'eng_value' => trim( $colls[2]->find('span')[0]->text() ),
                'rus_value' => trim( $colls[4]->text() ),
                'part_of_speech' => '???',
                'gender'=>'gender',
                'yandex_url'=> $yandex_url,
                // 'part_of_speech' => $part_of_speech,
            ]);
            $item->save();
            // $item->getYandexData();

            $ya = new Document($yandex_url, true);
            echo $ya->html();

            break;
        }

        // var_dump($table);
        // echo $table[0]->html();

        return $table;
    }

    public function test()
    {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        $translator = new Yandex_Translate();

        //Массив языков, с которых можно переводить
        echo '<pre>';
        $pairs = $translator->yandexGetLangsPairs();
        print_r($pairs);
        echo '</pre>';

        //Массив языков, на которые можно переводить
        echo '<pre>';
        $to = $translator->yandexGet_FROM_Langs();
        print_r($to);
        echo '</pre>';
    }

}