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





Auth::routes();



Route::group(['middleware' => ['auth']], function (){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('game', 'GameController');
    Route::get('/', 'GameController@profile')->name('welcome');
    Route::get('/rounds', 'GameController@rounds')->name('rounds');
    Route::post('/', 'GameController@userOptions');
    Route::get('/gameover', 'GameController@gameover')->name('gameover');

   // Route::post('/storeAjax/post', 'GameController@store');

});

