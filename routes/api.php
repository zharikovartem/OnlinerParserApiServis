<?php

use Illuminate\Http\Request;

$request_headers = apache_request_headers();
// var_dump($request_headers['Host']);
$trusted_adress = [
    '127.0.0.1',
    'https://zharikovartem.github.io/',
    'https://zharikovartem.github.io/epam-app/',
    'zharikovartem.github.io/epam-app/',
    'http://localhost:3000',
    '127.0.0.1:8000'
];

// echo $request_headers['Host'];
if ( in_array($request_headers['Host'], $trusted_adress) ) {
    // echo '!!!!!';
    $adress = 'https://'.$request_headers['Host'];
} else {
    $adress = '*';
}

header('Access-Control-Allow-Origin: '.$adress);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

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

Route::get('startCatalogParsing', 'Api\Parser\CatalogController@startCatalogParsing');//->middleware('token'); # Получить весь каталог
Route::get('startCatalogItem/{item}', 'Api\Parser\CatalogController@startCatalogItem')->middleware('token'); # Получить список товаров для раздела
Route::get('startProductParamParsing/{productType}', 'Api\Parser\CatalogController@startProductParamParsing')->middleware('token'); # Начать парсинг Описаний для раздела
Route::get('startProductParamParsing/{productType}/{productId}', 'Api\Parser\CatalogController@startProductParamItem')->middleware('token'); # Получить Описания для Товара

Route::get('getProductDescriptions/{productType}', 'Api\Parser\CatalogController@getProductDescriptions')->middleware('token'); # Получить готовые описания для товаров
Route::get('getProductPrices/{productType}', 'Api\Parser\CatalogController@getProductPrices')->middleware('token'); # Получить цены с ценами конкурентов

# ToDo:
Route::get('getToDoList', 'Api\ToDo\ToDoController@getToDoList');//->middleware('token');
Route::post('editToDoItem', 'Api\ToDo\ToDoController@editToDoItem')->middleware('token');
Route::post('createNewTask', 'Api\ToDo\ToDoController@createNewTask')->middleware('token');
// Route::post('createNewTask', 'Api\ToDo\ToDoController@createNewTask')->middleware('token');

Route::get('init-event', function() {
    $data = [
        'topic_id'=>'onNewData',
        'data'=>'someData: '.rand(1,100)
    ];

    \App\Classes\Socket\Pusher::sendDataToServer($data);
    var_dump($data);
});

Route::post('tasks/part', 'TaskController@getTasksPart');
Route::resource('tasks', 'TaskController');
