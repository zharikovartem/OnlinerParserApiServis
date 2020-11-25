<?php

namespace App\Services\Parsers;

use App\Models\Catalog;
use DiDom\Document; // gfhcth реьд

// use Sunra\PhpSimple\HtmlDomParser;
// use Symfony\Component\DomCrawler\Crawler;
// use Goutte\Client;

// use \Libraries\simplehtmldom\simple_html_dom;

// 
// use simplehtmldom\HtmlWeb;
// use simplehtmldom\simple_html_dom;

class OnlinerParser {
    

    public function Parse($p1, $p2, $p3) {
        // $num1 = strpos($p1, $p2);
        // if ($num1 === false) return 0;
        // $num2 = substr($p1, $num1);
        // return strip_tags(substr($num2, 0, strpos($num2, $p3)));

        $parts = explode($p1, $p2);
        echo count($parts).'count($parts)<br/>';

        foreach ($parts as $key => $part) {
            echo strip_tags(substr($part, 0, strpos($part, $p3))).'!<br/>';
        }
        return count($parts);
    }

    public function getProductCatalog2() {

        $catalog = Catalog::get();
        // dd($catalog);

        $base = 'https://catalog.onliner.by/';

        $document = new Document($base, true);
        $NamesById = [];

        foreach ($document->find('.catalog-navigation-classifier__item') as $key => $name) {
            $dataId = $name->getAttribute('data-id');
            if ( count(explode('brand-', $dataId)) == 1 ) {
                $NamesById[$name->getAttribute('data-id')] = $name->text();
            }
        }

        // var_dump($NamesById);

        $blocks = $document->find('.catalog-navigation-list__category');
        echo 'count blocks: '.count($blocks).'<br/>';

        foreach($blocks as $key => $block) {
            // echo $key.')'.$block->text().'<br/>';
            $blockId = $block->getAttribute('data-id');
            if ( isset($NamesById[$blockId]) ) {
                echo '<b><h3>'.$NamesById[$blockId].': </h3></b><br/>';
                $items = $block->find('.catalog-navigation-list__aside-title');
                $groups = $block->find('.catalog-navigation-list__dropdown');
                foreach ($items as $key => $item) {
                    $links = $groups[$key]->find('.catalog-navigation-list__dropdown-item');
                    echo '<b>'.$key.')</b> '.$item->text().':<br/>';
                    foreach ($links as $key => $link) {
                        $linkName = $link->find('.catalog-navigation-list__dropdown-title')[0]->text();
                        echo '--------------'.$linkName.'-------><b>'. explode('/', $link->getAttribute('href'))[0] .'</b><br/>';
                        $name = explode('?', explode( '/', $link->getAttribute('href') )[3] )[0];
                        $item = Catalog::create(
                            [
                                'name'=>$name,
                                'parent_id'=>'0',
                                'label'=>trim($linkName),
                                'labels'=>'startCatalogParsing',
                                'params'=>$link->getAttribute('href')
                            ]
                        );
                    }
                }
            }
        }


    }

    public function getProductCatalog() {
        $filename = 'simple_html_dom.php';
        // $result = arrey();

        include_once $filename;

        $html = file_get_html('https://catalog.onliner.by/');
        // echo '<br>!!!!!<br>'. $html;

        echo count($html->find('.catalog-navigation-list__dropdown-title')).'<br/><br/><br/><br/>';

        foreach ($html->find('.catalog-navigation-list__dropdown-title') as $value) {
            echo $value->innertext.'<br>';
        }

        echo date('h:i:s') . '<br/>';
        sleep(10);
        echo date('h:i:s') . '<br/>';

        $fistNames = $html->find('.catalog-navigation-classifier__item');

        echo 'fistNames count: '.count($fistNames).'<br/><br/>';

        $needIds = [];
        $NamesById = [];

        foreach ($fistNames as $fistName) {
            $atributes = $fistName->attr;
            $fistNamesText = $fistName->find('.catalog-navigation-classifier__item-title-wrapper')[0]->innertext;
            if ( count(explode('brand-', $atributes['data-id'])) == 1 ) {
                echo $atributes['data-id'].')'.$fistNamesText.'<br/>';
                $needIds[] = $atributes['data-id'];
                $NamesById[$atributes['data-id']] = $fistNamesText;
            }
           
        }

        var_dump($needIds);

        $blocks = $html->find('.catalog-navigation-list__category');
        echo '<br/><br/>blocks count: '.count($blocks).'<br/>';
        foreach ($blocks as $block) {
            $atributes = $block->attr;
            // if (in_array($atributes['data-id'], $needIds)) {
                echo '<b>Для '.$NamesById[$atributes['data-id']].': </b><br/>';
                $groups = $block->find('.catalog-navigation-list__aside-title');
                foreach ($groups as $group) {
                    echo $group->innertext.'<br/>';
                }
            // }
        }
        


        #catalog-navigation-list__dropdown-title
        // $containers = $html->find('.catalog-navigation-list__aside-item');
        // echo 'count1: '.count($containers).'<br>';

        // foreach ($containers as $key => $container) {
        //     $groupName = $container->find('.catalog-navigation-list__aside-title')[0];
        //     echo '<b>'.$key.') '.$groupName->innertext.'</b><br>';
        //     $groups = $container->find('.catalog-navigation-list__dropdown-item');
        //     foreach ($groups as $key => $group) {
        //         echo $group->href.'<br>';

        //         $item = Catalog::create(
        //             [
        //                 'name'=>$groupName->innertext,
        //                 'parent_id'=>'0',
        //                 'label'=>explode('?', $group->href)[0] ,
        //                 'labels'=>'startCatalogParsing'
        //             ]
        //         );

        //     }
        // }


        return '123';
    }

    public function onlinerAPI() {
        # https://catalog.onliner.by/sdapi/catalog.api/search/tires?group=1
        # https://catalog.onliner.by/sdapi/catalog.api/facets/tires

        $process = curl_init("https://b2bapi.onliner.by/oauth/token");
        curl_setopt($process, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($process, CURLOPT_USERPWD, "2cc512e4bd4c0c83c4d8:aa521e87294b6173f1c10d338910625896a0b684");
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_POSTFIELDS, array('grant_type' => 'client_credentials'));
        $token = curl_exec($process);
        curl_close($process);

        $token = json_decode($token, true)['access_token'];

        // $process = curl_init("https://b2bapi.onliner.by/sections");
        $process = curl_init("https://b2bapi.onliner.by/sections/21/manufacturers/3282/products/55780/articles");
        // $process = curl_init("https://b2bapi.onliner.by/sections/21/manufacturers");

        curl_setopt(
        $process, 
        CURLOPT_HTTPHEADER, 
        array(
            'Accept: application/json', 
            'Content-Type: application/json', 
            'Authorization: Bearer '.$token
        )
        );

        curl_setopt($process, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($process, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($process);
        curl_close($process);

        return json_decode($result, true);
    }
}


