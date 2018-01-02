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

	Route::resource('user', 'UserController', ['except' => ['show', 'destroy', 'create']]);
	Route::post('user/delete/{user}', 'UserController@softDelete');

	Route::resource('article', 'ArticleController', ['except' => ['show', 'destroy', 'create']]);

    Route::resource('category', 'CategoryController', ['except' => ['show', 'create']]);
    Route::post('category/all', 'CategoryController@allCategory');

    Route::post('tag/all', 'TagController@allTag');
});
