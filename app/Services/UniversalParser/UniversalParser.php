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

        echo $base;

        $table = $document->find('.table-voc');

        foreach ($table[0]->find('tr') as $i => $row) {
            $colls = $row->find('td');

            $response = 'no result';

            echo trim($colls[0]->html()).'->';
            echo trim($colls[2]->find('span')[0]->html()); 
            echo '='.trim($colls[4]->html()).'('.trim($colls[6]->html()).')';

            $rus_value = trim( $colls[4]->text() );
            $eng_value = trim( $colls[2]->find('span')[0]->text() );

            $check = Vocabulary::where('eng_value', $eng_value)->get();

            if (count($check) === 0) {
                $part_of_speech = self::getBablaData($colls, $eng_value, $rus_value);
            } else {
                $part_of_speech = '?';
            }

            $yandex_url = explode('ru-en', $colls[5]->find('a')[0]->href)[0].'en-ru' ; 

            

            // $url= 'https://www.babla.ru/%D0%B0%D0%BD%D0%B3%D0%BB%D0%B8%D0%B9%D1%81%D0%BA%D0%B8%D0%B9-%D1%80%D1%83%D1%81%D1%81%D0%BA%D0%B8%D0%B9/'.trim( $colls[2]->find('span')[0]->text() );
            
            #######################
            ## https://www.babla.ru/спряжения/английский/begin
            // $url= 'https://www.babla.ru/английский-русский/'.trim( $colls[2]->find('span')[0]->text() );
            // if (trim( $colls[2]->find('span')[0]->text() ) !== 'I') {
            //     try {
            //         $ya = new Document($url, true);
            //     } catch (Exception $e) {
            //         echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            //     }
            //     // echo $ya->html();
            //     if ($ya) {
            //         $part_of_speech_block = $ya->find('.quick-result-entry');
            //         $index = 0;
            //         if (count($part_of_speech_block) > 0) {
            //             for ($i=0; $i < count($part_of_speech_block); $i++) { 
            //                 $options = $part_of_speech_block[$i]->find('.quick-result-option'); // английские значения и суф.
            //                 $overviews = $part_of_speech_block[$i]->find('.quick-result-overview'); // русские значения
            //                 echo '<br/>count($options): '.count($options).'<br/>';
            //                 if (count($options)>0) {
            //                     $engResArr = $part_of_speech_block[$i]->find('.babQuickResult');
            //                     $suffix = $part_of_speech_block[$i]->find('.suffix');
            //                     if (count($engResArr) > 0) {
            //                         $engRes = $engResArr[0]->text();
            //                         $suffixVal = '???';
            //                         if (isset($suffix[0])) {
            //                             $suffixVal = $suffix[0]->text();
            //                         }
            //                         echo $i.') <b>'.$engRes.'</b>';
            //                         if (mb_strtolower($engRes) === $eng_value || mb_strtolower($engRes) === 'to '.$eng_value) {
            //                             echo '!!!!!'. $engRes .'('.$suffixVal.')<br/>';
            //                             //Проверить совпадения русских значений
            //                             // var_dump($overviews);
            //                             if (count($overviews)>0) {
            //                                 echo $suffixVal.'Значения: ';
            //                                 foreach ($overviews[0]->find('li') as $key => $li) {
            //                                     // Если русское значение полностью совпадает
            //                                     if ($li->text() === $rus_value) {
            //                                         $part_of_speech = $suffixVal;
            //                                     }
            //                                     echo $li->text().', ';
            //                                 }
            //                                 echo '<br/>';
            //                             }
            //                             // получить часть речи
            //                             // $part_of_speech = $suffixVal;
            //                         }
            //                     }
            //                 }
                            
            //                 // $rus_result = $part_of_speech_block[$ii]->find('li');
            //                 // foreach ($rus_result as $item => $res) {
            //                 //     echo $item.')'.$res->text();
            //                 // }
            //             }
            //         }
            //         echo '<br/><br/><br/>';
            //     }
            // }
            

            echo '<br/>';
            $item = new Vocabulary([
                'eng_value' => $eng_value,
                'rus_value' => $rus_value,
                'gender'=>'gender',
                'yandex_url'=> $yandex_url,
                'part_of_speech' => $part_of_speech,
            ]);
           
            // $item->getYandexData();

            # проверка на существование 
            

            if ( count($check) === 0) {
                $item->save();
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
        $part_of_speech = 'undefined';
        $url= 'https://www.babla.ru/английский-русский/'.trim( $colls[2]->find('span')[0]->text() );
        if (trim( $colls[2]->find('span')[0]->text() ) !== 'I') {
            try {
                $ya = new Document($url, true);
            } catch (Exception $e) {
                echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            }
            // echo $ya->html();
            if ($ya) {
                $part_of_speech_block = $ya->find('.quick-result-entry');
                $index = 0;
                if (count($part_of_speech_block) > 0) {
                    for ($i=0; $i < count($part_of_speech_block); $i++) { 
                        $options = $part_of_speech_block[$i]->find('.quick-result-option'); // английские значения и суф.
                        $overviews = $part_of_speech_block[$i]->find('.quick-result-overview'); // русские значения
                        echo '<br/>count($options): '.count($options).'<br/>';
                        if (count($options)>0) {
                            $engResArr = $part_of_speech_block[$i]->find('.babQuickResult');
                            $suffix = $part_of_speech_block[$i]->find('.suffix');
                            if (count($engResArr) > 0) {
                                $engRes = $engResArr[0]->text();
                                $suffixVal = '???';
                                if (isset($suffix[0])) {
                                    $suffixVal = $suffix[0]->text();
                                }
                                echo $i.') <b>'.$engRes.'</b>';
                                if (mb_strtolower($engRes) === $eng_value || mb_strtolower($engRes) === 'to '.$eng_value) {
                                    echo '!!!!!'. $engRes .'('.$suffixVal.')<br/>';
                                    //Проверить совпадения русских значений
                                    // var_dump($overviews);
                                    if (count($overviews)>0) {
                                        echo $suffixVal.'Значения: ';
                                        foreach ($overviews[0]->find('li') as $key => $li) {
                                            // Если русское значение полностью совпадает
                                            if ($li->text() === $rus_value) {
                                                $part_of_speech = $suffixVal;
                                            }
                                            echo $li->text().', ';
                                        }
                                        echo '<br/>';
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
                echo '<br/><br/><br/>';
            }
        }

        return $part_of_speech;
    }

}