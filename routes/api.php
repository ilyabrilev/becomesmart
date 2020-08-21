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
    Route::get('random', 'Api\WordController@random')
        ->middleware('cors');
    Route::get('words/{word}', 'Api\WordController@show');
});


Route::prefix('ajax')->group(function () {
    Route::get('random', 'Api\WordController@random');
    Route::get('words/{word}', 'Api\WordController@show');
    Route::post('like', 'Api\WordLikeController@toggle')
        ->middleware('auth:api');
});
