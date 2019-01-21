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


Route::get('/', 'GlossaryWordController@Index');
Route::get('word', 'GlossaryWordController@GetWordHtml');
Route::get('tag/words', 'GlossaryTagController@GetWordsByTagHtml');

Route::prefix('new')->group(function () {
    Route::get('/', 'GlossaryWordController@IndexNew');
    Route::get('word', 'GlossaryWordController@IndexNew');
    Route::get('tag/words', 'GlossaryTagController@GetWordsByTagHtml');
});

Auth::routes(['verify' => true]);

Route::get('/home', function() {
    return redirect('/');
});
