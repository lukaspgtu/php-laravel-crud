<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', 'App\AuthController@login')->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/', 'App\DashboardController@index')->name('home');

    Route::get('/categories', 'App\DashboardController@categories')->name('categories');

    Route::get('/products', 'App\DashboardController@products')->name('products');

});