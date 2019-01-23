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

Auth::routes(['verify' => true]);

Route::get('/home', function() {
    return redirect('/');
});

Route::prefix('ajax')->group(function () {
    Route::get('random', 'GlossaryWordController@GetRandomWordJson')
        ->middleware('cors');
    Route::get('word', 'GlossaryWordController@GetJson');
    Route::post('like', 'WordLikeController@ToggleLike')
        ->middleware('auth');
});

