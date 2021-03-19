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
            echo $row->html();
        }

        // var_dump($table);
        // echo $table[0]->html();

        return $table;
    }

}