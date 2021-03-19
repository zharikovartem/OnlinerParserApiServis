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

            $yandex_url = explode('ru-en', $colls[5]->find('a')[0]->href)[0].'en-ru' ; 

            $part_of_speech = '?';

            // $url= 'https://www.babla.ru/%D0%B0%D0%BD%D0%B3%D0%BB%D0%B8%D0%B9%D1%81%D0%BA%D0%B8%D0%B9-%D1%80%D1%83%D1%81%D1%81%D0%BA%D0%B8%D0%B9/'.trim( $colls[2]->find('span')[0]->text() );
            $url= 'https://www.babla.ru/английский-русский/'.trim( $colls[2]->find('span')[0]->text() );
            if (trim( $colls[2]->find('span')[0]->text() ) !== 'I') {
                try {
                    $ya = new Document($url, true);
                } catch (Exception $e) {
                    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
                }
                // echo $ya->html();
                if ($ya) {
                    echo $url.'<br/>';
                    $part_of_speech1 = $ya->find('.quick-result-option')[0]->find('span');
                    $part_of_speech = $part_of_speech1[0]->text();
                }
            }
            
            

            // var_dump($part_of_speech1[0]->tex);

            

            // echo '<h1>!!!'.$part_of_speech.'</h1>';

            echo '<br/>';
            $item = new Vocabulary([
                'eng_value' => trim( $colls[2]->find('span')[0]->text() ),
                'rus_value' => trim( $colls[4]->text() ),
                'gender'=>'gender',
                'yandex_url'=> $yandex_url,
                'part_of_speech' => $part_of_speech,
            ]);
           
            // $item->getYandexData();

            $item->save();
            // break;
            sleep(1);
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