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

// laravel 自带登录注册
Auth::routes();

Route::get('/', 'IndexController@index');
Route::get('archive', 'IndexController@archive')->name('archive');
Route::get('links', 'LinkController@index')->name('links');
Route::post('links/exchange', 'LinkController@exchange');
Route::get('categories/{article?}', 'ArticleController@categories')->name('categories');
Route::get('about', 'IndexController@about')->name('about');

Route::get('article/{article}/{slug?}', 'ArticleController@index')->name('article.index');


/* Dashboard Index */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
	Route::get('{path?}', function () {
		return view('admin.index');
	})->where('path', '[\/\w\.-]*')->name('admin');
});

Route::post('upload/{type}', 'UploadController@fileUpload');