<?php

namespace App\Services\Parsers;

use App\Models\Catalog;
use DiDom\Document; // gfhcth реьд
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Jobs\CatalogItemParsingJob;

// use Sunra\PhpSimple\HtmlDomParser;
// use Symfony\Component\DomCrawler\Crawler;
// use Goutte\Client;

// use \Libraries\simplehtmldom\simple_html_dom;

// 
// use simplehtmldom\HtmlWeb;
// use simplehtmldom\simple_html_dom;

class OnlinerParser {

    public static function getCatalog() {
        $catalog = Catalog::get();
        $catalogByName = array();
        foreach ($catalog as $key => $value) {
            $catalogByName[$value['name']] = $value;
        }

        $base = 'https://catalog.onliner.by/';

        $document = new Document($base, true);
        $NamesById = [];

        foreach ($document->find('.catalog-navigation-classifier__item') as $key => $name) {
            $dataId = $name->getAttribute('data-id');
            if ( count(explode('brand-', $dataId)) == 1 ) {
                $NamesById[$name->getAttribute('data-id')] = $name->text();
            }
        }

        $blocks = $document->find('.catalog-navigation-list__category');

        foreach($blocks as $key => $block) {
            $blockNum = $block->getAttribute('data-id');
            if ( isset($NamesById[$blockNum]) ) {
                # Создаем блок
                if ( !isset( $catalogByName[trim($NamesById[$blockNum])] ) ) {
                    $blockItem = Catalog::create(
                        [
                            'name'=>trim($NamesById[$blockNum]),
                            'parent_id'=>'0',
                            'label'=>trim($NamesById[$blockNum]),
                            'type'=>'block'
                        ]
                    );
                    $blockId = $blockItem->id;
                } else {
                    $blockId = $catalogByName[ trim($NamesById[$blockNum]) ]['id'];
                }


                $items = $block->find('.catalog-navigation-list__aside-title');
                $groups = $block->find('.catalog-navigation-list__dropdown');
                foreach ($items as $key => $item) {
                    $links = $groups[$key]->find('.catalog-navigation-list__dropdown-item');
                    if ( !isset( $catalogByName[ trim( $item->text() ) ] ) ) {
                        $subBlockItem = Catalog::create(
                            [
                                'name'=>trim($item->text()),
                                'parent_id'=>$blockId,
                                'label'=>trim($key),
                                'type'=>'subBlock',
                            ]
                        );
                        $subBlockItemId = $subBlockItem->id;
                    } else {
                        $subBlockItemId = $catalogByName[ trim($item->text()) ]['id'];
                    }

                    foreach ($links as $key => $link) {
                        $linkName = $link->find('.catalog-navigation-list__dropdown-title')[0]->text();
                        $name = explode('?', explode( '/', $link->getAttribute('href') )[3] )[0];
                        if (!isset($catalogByName[$name])) {
                            $item = Catalog::create(
                                [
                                    'name'=>$name,
                                    'parent_id'=> $subBlockItemId,
                                    'label'=>trim($linkName),
                                    'labels'=>trim($linkName),
                                    'url'=>explode('?', $link->getAttribute('href'))[0],
                                    'full_url'=>$link->getAttribute('href'),
                                    'type'=>'item'
                                ]
                            );
                        }
                    }
                }
            }
        }


    }

    public static function getCatalogItem($data) {
        $catalogItem = $data['name'];
        # Проверяем таблицу на существование:
        if (Schema::hasTable($catalogItem)) {
            // echo $catalogItem.' - Существует!';
        } else {
            Schema::create($catalogItem, function($table) {
                $table->increments('id');
                $table->integer('onliner_id');
                $table->integer('popularity');
                $table->timestamps();
                $table->string('onliner_key');
                $table->string('name');
                $table->string('full_name');
                $table->string('name_prefix');
                $table->string('extended_name');
                $table->mediumText('image_header_url')->nullable();
                $table->mediumText('descriptions');
                $table->mediumText('html_url');
                $table->decimal('price_min', 8, 2);

                // $table->mediumText('params')->nullable();
            });

            // echo $catalogItem.' - Создана!';
        }

        // echo '
        // Стартуем: '.$data['part'].'
        
        // ';
        # https://catalog.onliner.by/sdapi/catalog.api/search/hoods?page=1
        $baseUrl = 'https://catalog.onliner.by/sdapi/catalog.api/search/'.$catalogItem.'?page='.$data['part'];
        // $document = new Document($baseUrl, true);
        $pageJSON = file_get_contents($baseUrl);
        $pageObject = json_decode($pageJSON, true);

        $productsData = $pageObject['products'];
        $productsToInsert = array();
        $productsToUpdate = array();
        $onlinerIds = array();

        foreach ($productsData as $index => $item) {
            $onlinerIds[] = $item['id'];
            $productItem = [
                'name' => $item['name'],
                'onliner_id' => $item['id'],
                'onliner_key' => $item['key'],
                'full_name' => $item['full_name'],
                'name_prefix' => $item['name_prefix'],
                'extended_name' => $item['extended_name'],
                'image_header_url' => $item['images']['header'],
                'descriptions' => $item['description'],
                'price_min' => floatval($item['prices']['price_min']['amount']),
                'popularity' => ((int)$data['part']-1) * 30 + (int)$index + 1,
                'html_url' => $item['html_url']
            ];
            
            $productsToInsert[] = $productItem;
        }

        # Получаем существующие товары:
        $oldProducts = DB::table($catalogItem)
                    ->whereIn('onliner_id', $onlinerIds)
                    ->get();
        // var_dump($oldProducts);
        foreach ($oldProducts as $keyO => $oldProduct) {
            // echo $oldProduct->onliner_id;
            foreach ($productsToInsert as $keyP => $product) {
                if ($product['onliner_id'] == $oldProduct->onliner_id) {
                    // $oldProduct->updated_at = now();
                    $itemToUpdate = [
                        'id'=>$oldProduct->id
                    ];
                    $productsToUpdate[] = $itemToUpdate;
                    unset($productsToInsert[$keyP]);
                }
            }
        }

        # Добавляем в базу:
        if (count($productsToInsert) > 0) {
            DB::table($catalogItem)->insert($productsToInsert);
        } else {
            // foreach ($productsToUpdate as $key => $value) {
                // DB::table('users')
                //     ->where('id', $value['id'])
                //     ->update(['updated_at'=>now()]);
            // }
        }
        


        if ($pageObject['page']['last'] == $data['part']) {
            echo 'end';
        } else {
            // echo 'next';
            $data['part']++;
            dispatch(new CatalogItemParsingJob($data));
            echo (int)memory_get_peak_usage()/1000000 . '';
        }
    }

    # Получение параметров для обработки:
    # Request URL: https://catalog.onliner.by/sdapi/catalog.api/facets/hob_cooker

    # Получение цены и продавцов товара
    # Request URL: https://catalog.onliner.by/sdapi/catalog.api/products/exite1013
}


