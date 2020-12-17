<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Api\Auth\LoginController@login');
Route::post('register', 'Api\Auth\RegisterController@register');

Route::get('authMe/{token}', 'Api\Auth\AuthController@authMe');


// Route::post('register', 'Api\Parser\CatalogController@startCatalogParsing'); # Получить весь каталог

# https://artcrmvds.h1n.ru/api/getCatalogParts
Route::resource('getCatalogParts', Api\Parser\CatalogController::class)->middleware('token'); // Получить все разделы Catalog
// Route::get('getCatalogParts', function () {
//     // Api\Parser\CatalogController::class;
//     Route::resource('getCatalogParts', Api\Parser\CatalogController::class);
//   })->middleware('token');

Route::get('startCatalogParsing', 'Api\Parser\CatalogController@startCatalogParsing')->middleware('token'); # Получить весь каталог
Route::get('startCatalogItem/{item}', 'Api\Parser\CatalogController@startCatalogItem')->middleware('token'); # Получить список товаров для раздела
Route::get('startProductParamParsing/{productType}', 'Api\Parser\CatalogController@startProductParamParsing')->middleware('token'); # Начать парсинг Описаний для раздела
Route::get('startProductParamParsing/{productType}/{productId}', 'Api\Parser\CatalogController@startProductParamItem')->middleware('token'); # Получить Описания для Товара

Route::get('getProductDescriptions/{productType}', 'Api\Parser\CatalogController@getProductDescriptions')->middleware('token'); # Получить готовые описания для товаров
Route::get('getProductPrices/{productType}', 'Api\Parser\CatalogController@getProductPrices')->middleware('token'); # Получить цены с ценами конкурентов

Route::get('init-event', function() {
    $data = [
        'topic_id'=>'onNewData',
        'data'=>'someData: '.rand(1,100)
    ];

    \App\Classes\Socket\Pusher::sendDataToServer($data);
    var_dump($data);
});
