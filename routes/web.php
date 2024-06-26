<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Artisan;
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

Route::view('/', 'landing');

Route::view('/almaty', 'almaty');

Route::view('/thanks', 'thankyou');

Route::view('/detox', 'detox');

Route::post('/', 'OrderController@placeOrder');

//Route::post('/cart', 'OrderController@placeCartOrder');

Route::view('/go', 'page');

Route::view('/cart', 'cart');

Route::view('/quiz', 'quiz');

Route::view('/checkout', 'checkout');

Route::post('/checkout', [OrderController::class, 'eatFitGo']);

Route::get('/products', function () {
    return response()->json(Product::where('is_active', true)->orderBy('category_id')->get());
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/clear-cache', function() {
    Artisan::call('optimize:clear');
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

    Route::get('/pwd', 'LoginController@pwd')->name('pwd');
    Route::post('/pwd', 'LoginController@pwdUpdate')->name('pwd.update');

    Route::get('/list', 'ListController@index')->name('list');
    Route::post('/list', 'ListController@fetchOrders')->name('fetch');

    Route::post('/logout', 'LoginController@logout')->name('logout');
});
