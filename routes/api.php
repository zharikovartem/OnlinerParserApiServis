<?php

use Illuminate\Http\Request;

if ( isset($_SERVER['HTTP_ORIGIN'])) {
    $http_origin = $_SERVER['HTTP_ORIGIN'];
    switch ($_SERVER['HTTP_ORIGIN']) {
        case 'https://zharikovartem.github.io':
            $http_origin = $_SERVER['HTTP_ORIGIN'];
            break;

        case 'http://localhost:3000':
            $http_origin = $_SERVER['HTTP_ORIGIN'];
            break;
        
        default:
            $http_origin = '*';
            break;
    }
} else {
    $http_origin = '*';
}
header('Access-Control-Allow-Origin:'.$http_origin); //.', x-auth-token');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type, x-auth-token');
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

Route::post('tasks/part', 'TaskController@getTasksPart')->middleware('token');
Route::resource('tasks', 'TaskController');

Route::resource('orders', 'OrderController');

Route::resource('account', 'AccountController')->middleware('token');

Route::resource('taskList', 'TaskListController')->middleware('token');

Route::get('project/{item}', 'BackendController@getNeedBackends');
Route::resource('project', 'ProjectController');

Route::resource('backend', 'BackendController');

Route::get('models/{item}', 'ModelsInstanseController@getCurrentModel');
Route::resource('models', 'ModelsInstanseController');

Route::get('currentControllers/{item}', 'ControllersController@getCurrentControllers');
Route::resource('controllers', 'ControllersController');

Route::resource('controllerMethods', 'ControllerMethodsController');

Route::get('getVocabularyList', 'Api\Parser\VocabularyCreateController@startVocabularyParsing');

Route::get('getVocabularyPart/{part}', 'VocabularyController@getVocabularyPart')->middleware('token');
Route::resource('vocabulary', 'VocabularyController');
