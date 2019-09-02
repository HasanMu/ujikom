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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['as' => 'api.'], function () {
    Route::resource('user', 'Api\UserController');
    Route::apiResource('bidang-studi', 'Api\BidangStudiController');
    Route::get('bidang-studis', function () {
        return \App\BidangStudi::all();
    });
    Route::apiResource('kompetensi-keahlian', 'Api\KompetensiKeahlianController');
});
