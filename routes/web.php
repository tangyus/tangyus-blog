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
    return view('articles.index');
});

/* Dashboard Index */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
	Route::get('{path?}', function () {
		return view('admin.index');
	})->where('path', '[\/\w\.-]*');
});

// laravel 自带登录注册
Auth::routes();