<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');
    Route::post('createproduct', 'App\Http\Controllers\ProductController@create');
    Route::get('showproduct', 'App\Http\Controllers\ProductController@show');
    Route::post('findproduct', 'App\Http\Controllers\ProductController@find');
    Route::post('updateProduct', 'App\Http\Controllers\ProductController@update');
    Route::post('deleteProduct', 'App\Http\Controllers\ProductController@delete');
    Route::get('showAccount', 'App\Http\Controllers\AuthController@showAccount');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});