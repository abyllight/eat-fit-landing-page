<?php

use Illuminate\Support\Facades\Route;
use App\Product;
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
    return view('landing');
});

Route::get('/detox', function () {
    return view('detox');
});

/*Route::get('/products', function () {
    return view('products');
});*/

Route::post('/', 'OrderController@placeOrder');

Route::post('/cart', 'OrderController@placeCartOrder');

Route::get('/page', function () {
    return view('page');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/products', function () {
    return response()->json(Product::where('is_active', true)->get());
});

Route::get('/login', 'LoginController@show')->name('login')->middleware('guest');

Route::post('/login', 'LoginController@login')->name('login.post');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/products', 'ProductController@index')->name('products');

    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product/create', 'ProductController@store')->name('product.store');

    Route::get('/product/{id}/edit', 'ProductController@edit')->name('product.edit');
    Route::post('/product/{id}/edit', 'ProductController@update')->name('product.update');
    Route::post('/product/{id}/deactivate', 'ProductController@deactivate')->name('product.deactivate');
    Route::post('/product/{id}/activate', 'ProductController@activate')->name('product.activate');

    Route::post('/logout', 'LoginController@logout')->name('logout');
});
