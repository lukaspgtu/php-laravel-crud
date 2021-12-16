<?php

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

Route::post('/login', 'Api\UserController@login');


Route::middleware('auth:api')->group(function () {

    Route::get('/category', 'Api\CategoryController@index');

    Route::post('/category', 'Api\CategoryController@store');

    Route::put('/category/{id}', 'Api\CategoryController@update');

    Route::delete('/category/{id}', 'Api\CategoryController@delete');


    Route::get('/product', 'Api\ProductController@index');

    Route::post('/product', 'Api\ProductController@store');

    Route::put('/product/{id}', 'Api\ProductController@update');

    Route::delete('/product/{id}', 'Api\ProductController@delete');

});