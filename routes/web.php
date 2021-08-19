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

Auth::routes();

Route::get('/', 'WelcomeController@index')->name('home');

Route::middleware('auth')->namespace('Dashboard')->name('dashboard')->prefix('dashboard')->group(function(){
    // Dashboard index
    Route::get('/', 'HomeController@index');

    Route::name('.product.')->prefix('product')->group(function(){
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('/add', 'ProductController@addProduct')->name('add');
        Route::post('/create', 'ProductController@createProduct')->name('create');
    });
});
