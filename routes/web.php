<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpinfo',function(){
    phpinfo();
});

// Route::get('/md5',function(){
//     echo md5($_GET['s']);
// });

/*测试*/
Route::prefix('/test')->group(function(){
    Route::get('/redis','TestController@testRedis');
    Route::get('/test002','TestController@test002');
    Route::get('/test003','TestController@test003');
    Route::get('/wx/token','TestController@getAccessToken');
    Route::get('/curl1','TestController@curl1');
    Route::get('/curl2','TestController@curl2');
    Route::get('/guzzle1','TestController@guzzle1');

    /*get和post请求*/
    Route::get('/GetRequest','TestController@GetRequest');
    Route::post('/PostRequest','TestController@PostRequest');
    Route::post('/Posturlencodes','TestController@Posturlencodes');
    Route::post('/PostRaw','TestController@PostRaw');

    Route::post('/upload','TestController@upload');//上传文件

    /*redis*/
    Route::get('/redis1','TestController@redis1');

    //**测试 */
    Route::get('/Testmd5','TestController@Testmd5');
   /*接收数据*/
    Route::get('/verifySign','TestController@verifySign');

    /*取模*/
    Route::get('/take','TestController@take');

    Route::get('/decrypt','TestController@decrypt');
    Route::get('/decrypt1','TestController@decrypt1');
    
});

/** api接口 */
Route::prefix('/api')->group(function(){
    Route::get('/user/info','Api\UserController@info');
    Route::post('user/reg','Api\UserController@reg');
    Route::get('weather','Api\UserController@weather'); //天气接口
});

/**商品详情*/
Route::prefix('/goods')->middleware('api.filter')->group(function(){
    Route::get('/index','GoodsController@index');
    Route::get('/visits','GoodsController@visits');  //访问量
    Route::get('/server','GoodsController@server');  //测试SERVER
});
