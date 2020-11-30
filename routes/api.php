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


Route::resource('getCatalogParts', Api\Parser\CatalogController::class);

Route::get('startCatalogParsing', 'Api\Parser\CatalogController@startCatalogParsing');
Route::get('startCatalogItem/{item}', 'Api\Parser\CatalogController@startCatalogItem');
