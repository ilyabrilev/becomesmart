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

Route::get('/', 'Web\WordController@index');
Route::get('words/{word}', 'Web\WordController@show');
Route::get('tags/{tag}/words', 'Web\TagWordsController@index');

Auth::routes(['verify' => true]);

Route::get('/home', function() {
    return redirect('/');
});

