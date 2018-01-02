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

Route::group([
	'middleware' => ['auth:api', 'admin'],
	'namespace' => 'Api'
], function () {
	Route::get('/admin', 'IndexController@index');

    // 用户路由
	Route::resource('user', 'UserController', ['except' => ['show', 'destroy', 'create']]);
	Route::post('user/delete/{user}', 'UserController@softDelete');

    // 文章路由
	Route::resource('article', 'ArticleController', ['except' => ['show', 'destroy', 'create']]);

    // 标签路由
    Route::resource('category', 'CategoryController', ['except' => ['show', 'create']]);
    Route::post('category/all', 'CategoryController@allCategory');

    // 标签路由
    Route::resource('tag', 'TagController', ['except' => ['show', 'create']]);
    Route::post('tag/all', 'TagController@allTag');

    // 友链路由
    Route::resource('link', 'LinkController', ['except' => ['show', 'create']]);
});
