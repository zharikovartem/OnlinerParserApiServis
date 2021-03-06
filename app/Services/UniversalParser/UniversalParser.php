<?php

namespace App\Services\UniversalParser;

use DiDom\Document;
use App\Vocabulary;
use App\Services\UniversalParser\Yandex_Translate;

class UniversalParser {

    public static function getVocabularyList($page, $start, $stop) 
    {
        // $base = 'https://audio-english.ru/frequencydict/s_1_po_500/page-0/';
        $base = 'https://audio-english.ru/frequencydict/s_'.$start.'_po_'.$stop.'/page-'.$page.'/';
        $document = new Document($base, true);

        echo $base.'<br/><br/><br/>';

        $table = $document->find('.table-voc');

        foreach ($table[0]->find('tr') as $i => $row) {
            $colls = $row->find('td');

            $response = 'no result';

            // echo trim($colls[0]->html()).'->';
            // echo trim($colls[2]->find('span')[0]->html()); 
            // echo '='.trim($colls[4]->html()).'('.trim($colls[6]->html()).')';

            $rus_value = trim( $colls[4]->text() );
            $eng_value = trim( $colls[2]->find('span')[0]->text() );
            $occurrence = trim( $colls[6]->text() );

            // echo '>>>>>>$occurrence'.$occurrence.'<br/>';

            $check = Vocabulary::where('eng_value', $eng_value)->get();

            if (count($check) === 0) {
                $bablaData = self::getBablaData($colls, $eng_value, $rus_value);
                $part_of_speech = $bablaData['part_of_speech'];
                $eng_sound = $bablaData['eng_sound'];
            } else {
                $part_of_speech = '?';
                $eng_sound = null;
            }

            $yandex_url = explode('ru-en', $colls[5]->find('a')[0]->href)[0].'en-ru' ; 
           

            // echo '<br/>';
            $item = new Vocabulary([
                'eng_value' => $eng_value,
                'rus_value' => $rus_value,
                'gender'=>'gender',
                'yandex_url'=> $yandex_url,
                'part_of_speech' => $part_of_speech,
                'babla_url' => 'https://www.babla.ru/английский-русский/'.trim( $colls[2]->find('span')[0]->text() ),
                'occurrence' => (int) $occurrence,
                'eng_sound' => $eng_sound,
            ]);
           
            // $item->getYandexData();

            # проверка на существование 
            

            if ( count($check) === 0) {
                $item->save();
            } else {
                if ( (int)trim( $colls[0]->text() ) !== $check[0]->id ) {
                    $item->save();
                }

                echo $check[0]->id.'<br/>';
            }
            
            
            // break;
            // sleep(2);
        }

        // var_dump($table);
        // echo $table[0]->html();

        return $table;
    }

    public static function getBablaData($colls, $eng_value, $rus_value)
    {
        $response['part_of_speech'] = '???';
        $response['eng_sound'] = null;

        $url= 'https://www.babla.ru/английский-русский/'.trim( $colls[2]->find('span')[0]->text() );
        if (trim( $colls[2]->find('span')[0]->text() ) !== 'I') {
            try {
                $ya = new Document($url, true);
            } catch (Exception $e) {
                // echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            }
            // echo $ya->html();
            if ($ya) {
                $part_of_speech_block = $ya->find('.quick-result-entry');
                $index = 0;
                if (count($part_of_speech_block) > 0) {
                    for ($i=0; $i < count($part_of_speech_block); $i++) { 
                        $options = $part_of_speech_block[$i]->find('.quick-result-option'); // английские значения и суф.
                        $overviews = $part_of_speech_block[$i]->find('.quick-result-overview'); // русские значения
                        // echo '<br/>count($options): '.count($options).'<br/>';
                        if (count($options)>0) {
                            $engResArr = $part_of_speech_block[$i]->find('.babQuickResult');
                            $suffix = $part_of_speech_block[$i]->find('.suffix');
                            if (count($engResArr) > 0) {
                                $engRes = $engResArr[0]->text();
                                $suffixVal = '???';
                                if (isset($suffix[0])) {
                                    $suffixVal = $suffix[0]->text();
                                }
                                // echo $i.') <b>'.$engRes.'</b>';
                                if (mb_strtolower($engRes) === $eng_value || mb_strtolower($engRes) === 'to '.$eng_value) {
                                    echo '!!!!!'. $engRes .'('.$suffixVal.')<br/>';
                                    //Проверить совпадения русских значений
                                    // var_dump($overviews);
                                    if (count($overviews)>0) {
                                        // echo $suffixVal.'Значения: ';
                                        foreach ($overviews[0]->find('li') as $key => $li) {
                                            // Если русское значение полностью совпадает
                                            if ($li->text() === $rus_value) {
                                                $response['part_of_speech'] = $suffixVal;
                                                // $this->eng_sound = explode("'", $options->find('.bab-quick-sound')[0]->getAttribute('href') )[1];

                                                $response['eng_sound'] = explode("'", $options[0]->find('.bab-quick-sound')[0]->getAttribute('href') )[1];
                                            }
                                            // echo $li->text().', ';
                                        }
                                        // echo '<br/>';
                                    }
                                    // получить часть речи
                                    // $part_of_speech = $suffixVal;
                                }
                            }
                        }
                        
                        // $rus_result = $part_of_speech_block[$ii]->find('li');
                        // foreach ($rus_result as $item => $res) {
                        //     echo $item.')'.$res->text();
                        // }
                    }
                }
                // echo '<br/><br/><br/>';
            }
        }

        return $response;
    }

}