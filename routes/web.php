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

Route::get('article/{article}/{slug?}', 'ArticleController@index')->name('article.index');
Route::get('archive', function () {
    return view('articles.archive');
})->name('archive');


/* Dashboard Index */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
	Route::get('{path?}', function () {
		return view('admin.index');
	})->where('path', '[\/\w\.-]*')->name('admin');
});

Route::post('upload', 'UploadController@fileUpload');