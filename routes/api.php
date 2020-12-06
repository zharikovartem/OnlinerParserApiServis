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


Route::resource('getCatalogParts', Api\Parser\CatalogController::class); // Получить все разделы Catalog

Route::get('startCatalogParsing', 'Api\Parser\CatalogController@startCatalogParsing'); # Получить весь каталог
Route::get('startCatalogItem/{item}', 'Api\Parser\CatalogController@startCatalogItem'); # Получить список товаров для раздела
Route::get('startProductParamParsing/{productType}', 'Api\Parser\CatalogController@startProductParamParsing'); # Получить Описания для раздела
Route::get('startProductParamParsing/{productType}/{productId}', 'Api\Parser\CatalogController@startProductParamItem'); # Получить Описания для Товара



