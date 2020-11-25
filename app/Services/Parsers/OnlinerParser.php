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

    private function createNewCatalog($data) {
        $item = Catalog::create(
            [
                'name'=>$data['name'],
                'parent_id'=>'0',
                'label'=>trim($linkName),
                'labels'=>'startCatalogParsing',
                'params'=>$link->getAttribute('href')
            ]
        );
    }

    public static function getProductCatalog() {

        $catalog = Catalog::get();
        $catalogByName = array();
        foreach ($catalog as $key => $value) {
            $catalogByName[$value['name']] = $value;
        }
        echo 'Всего записей в Catalog: '.count($catalogByName).'<br/>';



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

                        if (!isset($catalogByName[$name])) {
                            $item = Catalog::create(
                                [
                                    'name'=>$name,
                                    'parent_id'=>'0',
                                    'label'=>trim($linkName),
                                    'labels'=>trim($linkName),
                                    'params'=>$link->getAttribute('href')
                                ]
                            );
                        }
                    }
                }
            }
        }


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


