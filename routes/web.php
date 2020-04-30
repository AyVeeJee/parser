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

Route::get('/parser_table', 'ParserController@index');
Route::get('/parser_table/action', 'ParserController@action')->name('parser_table.action');


Auth::routes();

Route::get('/home', 'HomeController@index');
