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

Route::get('/vue/spa/{any}', function () {
    return view('/vue/spa');
})->where('any', '.*');

Route::get('hello', 'HelloController@index');

Route::get('/', 'TimesController@index');

Route::get('create', 'TimesController@create');

Route::post('create', 'TimesController@store');

Route::get('edit/{id}', 'TimesController@edit');

Route::post('edit', 'TimesController@update');

Route::get('delete/{id}', 'TimesController@show');

Route::post('delete', 'TimesController@delete');