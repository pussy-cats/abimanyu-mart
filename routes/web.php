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

Route::prefix('product')->group(function(){
    Route::get('/', 'ProductController@index')->name('productGuestIndex');
    Route::get('/detail/{id}', 'ProductController@detailProduct')->name('productGuestDetail');
});

Route::middleware('auth')->group(function(){
    Route::get('invoice/{id}', 'InvoiceController@index')->name('invoiceIndex');
});

Route::middleware('auth')->group(function(){
    Route::group(['middleware' => ['role:admin']], function(){
        Route::namespace('Dashboard')->name('dashboard')->prefix('dashboard')->group(function(){
            // Dashboard index
            Route::get('/', 'HomeController@index');
    
            Route::name('.admin.')->prefix('admin')->group(function(){
                Route::get('/', 'AdminController@index')->name('index');
                Route::get('/add', 'AdminController@addAdmin')->name('add');
                Route::get('/edit/{id}', 'AdminController@editAdmin')->name('edit');
                Route::get('/delete/{id}', 'AdminController@deleteAdmin')->name('delete');
                Route::post('/create', 'AdminController@createAdmin')->name('create');
                Route::post('/update/{id}', 'AdminController@updateAdmin')->name('update');
            });
    
            Route::name('.user.')->prefix('user')->group(function(){
                Route::get('/', 'UserController@index')->name('index');
                Route::get('/add', 'UserController@addUser')->name('add');
                Route::get('/edit/{id}', 'UserController@editUser')->name('edit');
                Route::get('/delete/{id}', 'UserController@deleteUser')->name('delete');
                Route::post('/create', 'UserController@createUser')->name('create');
                Route::post('/update/{id}', 'UserController@updateUser')->name('update');
            });
    
            Route::name('.product.')->prefix('product')->group(function(){
                Route::get('/', 'ProductController@index')->name('index');
                Route::get('/add', 'ProductController@addProduct')->name('add');
                Route::get('/edit/{id}', 'ProductController@editProduct')->name('edit');
                Route::get('/delete/{id}', 'ProductController@deleteProduct')->name('delete');
                Route::post('/create', 'ProductController@createProduct')->name('create');
                Route::post('/update/{id}', 'ProductController@updateProduct')->name('update');
            });

            Route::name('.checkout.')->prefix('checkout')->group(function(){
                Route::get('/', 'CheckoutController@index')->name('index');
                Route::get('/detail/{id}', 'CheckoutController@detailCheckout')->name('detail');
            });
        });
    });
});

Route::middleware('auth')->group(function(){
    Route::group(['middleware' => ['role:user']], function(){
        Route::name('cart.')->prefix('cart')->group(function(){
            Route::get('/', 'CartController@index')->name('index');
            Route::get('/add/{id}', 'CartController@addCart')->name('add');
            Route::name('quantity.')->prefix('quantity')->group(function(){
                Route::get('/plus/{id}', 'CartController@plusQuantity')->name('plus');
                Route::get('/minus/{id}', 'CartController@minusQuantity')->name('minus');
            });
            Route::get('/delete/{id}', 'CartController@deleteCart')->name('delete');
        });
    
        Route::name('checkout.')->prefix('checkout')->group(function(){
            Route::get('/', 'CheckoutController@index')->name('index');
            Route::get('/add', 'CheckoutController@addCheckout')->name('add');
            Route::get('/detail/{id}', 'CheckoutController@detailCheckout')->name('detail');
            Route::post('/create', 'CheckoutController@createCheckout')->name('create');
        });

        Route::name('rajaongkir.')->prefix('rajaongkir')->group(function(){
            Route::get('/province', 'RajaOngkirController@getProvince')->name('province');
            Route::get('/city/{id}', 'RajaOngkirController@getCity')->name('city');
            Route::get('/service/{cityId}/{courierId}', 'RajaOngkirController@getService')->name('service');
        });
    });
});
