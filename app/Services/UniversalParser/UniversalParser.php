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

            $response = 'no result';

            echo trim($colls[0]->html()).'->';
            echo trim($colls[2]->find('span')[0]->html()); 
            echo '='.trim($colls[4]->html()).'('.trim($colls[6]->html()).')';

            
            $postFields = '[{"Text":"'.trim( $colls[2]->find('span')[0]->text() ).'"}]';

            echo '<br/>'.$postFields.'<br/>';

            include_once 'Yandex_Translate.php';
            $pairs = $translator->yandexGetLangsPairs();
            print_r($pairs);

            // $curl = curl_init();

            // curl_setopt_array($curl, [
            //     CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2",
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_ENCODING => "",
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 30,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => "POST",
            //     CURLOPT_POSTFIELDS => "q=Hello%2C%20world!&source=en&target=es",
            //     CURLOPT_HTTPHEADER => [
            //         "accept-encoding: application/gzip",
            //         "content-type: application/x-www-form-urlencoded",
            //         "x-rapidapi-host: google-translate1.p.rapidapi.com",
            //         "x-rapidapi-key: a20a4f686emshd81a4a63d9f86cap1dca45jsn16cfe3f7ef53"
            //     ],
            // ]);

            // $response = curl_exec($curl);
            // $err = curl_error($curl);

            // curl_close($curl);

            // if ($err) {
            //     echo "cURL Error #:" . $err;
            // } else {
            //     echo $response;
            // }

            echo '<br/>';
            $item = new Vocabulary([
                'eng_value' => trim( $colls[2]->find('span')[0]->text() ),
                'rus_value' => trim( $colls[4]->text() ),
                'part_of_speech' => '???',
                'gender'=>'gender',
                'yandex_url'=> json_encode($response),
                // 'part_of_speech' => $part_of_speech,
            ]);
            $item->save();
            // $item->getYandexData();

            break;
        }

        // var_dump($table);
        // echo $table[0]->html();

        return $table;
    }

}