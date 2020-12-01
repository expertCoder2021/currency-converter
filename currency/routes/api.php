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
Route::group(['namespace' => 'api'], function () {
    Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
        Route::post('/login', 'AuthController@login');
        Route::post('/currencyDetails', 'APIController@currencyDetails');
        Route::post('/currencyHistory', 'APIController@currencyHistory');
        Route::post('/currencyList', 'APIController@currencyList');
        Route::get('/currencySingleHistory/{id}', 'APIController@currencySingleHistory');
        Route::post('/historyOfCurrency', 'APIController@historyOfCurrency');
        Route::get('/getCurrencyList', 'APIController@getCurrencyList');
        Route::post('/currencyExchangeRate', 'APIController@currencyExchangeRate');
        
    });
    
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
});