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

Auth::routes(['register' => false, 'login' => false]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin', 'cors']], function () {
    // Route::resource('user', 'UserController');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-/_.]+)?');
});
