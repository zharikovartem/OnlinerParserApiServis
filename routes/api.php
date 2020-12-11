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
Route::resource('getCatalogParts', Api\Parser\CatalogController::class); // Получить все разделы Catalog

Route::get('startCatalogParsing', 'Api\Parser\CatalogController@startCatalogParsing'); # Получить весь каталог
Route::get('startCatalogItem/{item}', 'Api\Parser\CatalogController@startCatalogItem'); # Получить список товаров для раздела
Route::get('startProductParamParsing/{productType}', 'Api\Parser\CatalogController@startProductParamParsing'); # Начать парсинг Описаний для раздела
Route::get('startProductParamParsing/{productType}/{productId}', 'Api\Parser\CatalogController@startProductParamItem'); # Получить Описания для Товара

Route::get('getProductDescriptions/{productType}', 'Api\Parser\CatalogController@getProductDescriptions'); # Получить готовые описания для товаров
Route::get('getProductPrices/{productType}', 'Api\Parser\CatalogController@getProductPrices'); # Получить цены с ценами конкурентов


