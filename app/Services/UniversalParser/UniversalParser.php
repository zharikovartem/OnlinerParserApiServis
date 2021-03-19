<?php

namespace App\Services\UniversalParser;

use DiDom\Document;
use App\Vocabulary;

class UniversalParser {

    public static function getVocabularyList($page, $start, $stop) 
    {
        $base = 'https://audio-english.ru/frequencydict/s_1_po_500/page-0/';
        // $base = 'https://audio-english.ru/frequencydict/s_'.$start.'_po_'.$stop.'/page-'.$page.'/';
        $document = new Document($base, true);

        $table = $document->find('.table-voc');

        foreach ($table[0]->find('tr') as $i => $row) {
            $colls = $row->find('td');
            echo trim($colls[0]->html()).'->';
            echo trim($colls[2]->find('span')[0]->html()); 
            echo '='.trim($colls[4]->html()).'('.trim($colls[6]->html()).')';

            echo '<br/>';
            $item = new Vocabulary([
                'eng_value' => trim($colls[2]->find('span')[0]->text()),
                'rus_value' => trim($colls[4]->text(),
                'part_of_speech' => '???',
                'gender'=>'gender'
            ]);
            $item->save();
        }

        // var_dump($table);
        // echo $table[0]->html();

        return $table;
    }

}