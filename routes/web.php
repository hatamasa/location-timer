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

use Illuminate\Support\Facades\Route;

Route::get('/vue/test', function () {
    return view('/vue/test');
});
Route::get('/vue/test/{any}', function () {
    return view('/vue/test');
})->where('any', '.*');

Route::get('/vue/todo', function () {
    return view('/vue/todo');
});

// Basic認証有り
Route::group(['middleware' => 'auth.very_basic'], function () {

    Route::get('hello', 'HelloController@index');

    Route::get('/', 'TimesController@index');

    Route::get('create', 'TimesController@create');

    Route::post('create', 'TimesController@store');

    Route::get('edit/{id}', 'TimesController@edit');

    Route::post('edit', 'TimesController@update');

    Route::get('delete/{id}', 'TimesController@show');

    Route::post('delete', 'TimesController@delete');
});

Route::get('myList', function () {
    return view('/time/my_list');
});