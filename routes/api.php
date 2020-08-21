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

Route::prefix('public')->middleware('cors')->group(function () {
    Route::get('random', 'GlossaryWordController@getRandomWordJson')
        ->middleware('cors');
    Route::get('word', 'GlossaryWordController@getWordJson');
});


Route::prefix('ajax')->group(function () {
    Route::get('random', 'GlossaryWordController@getRandomWordJson');
    Route::get('word', 'GlossaryWordController@GetJson');
    Route::post('like', 'WordLikeController@toggleLike')
        ->middleware('auth');
});
