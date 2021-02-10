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

Route::get('/', function () {
    $leads['add']=array(
        array(
            'name'=>' Индивидуальное меню',
            'custom_fields'=>array(
                array(
                    'id'=>478771,
                    'values'=>array(
                        array(
                            'value'=>'phone',
                        ),
                    ),
                ),
                array(
                    'id'=>320995,
                    'values'=>array(
                        array(
                            'id'=>766689,
                            'value'=>'Сайт',
                        )
                    ),
                ),
            ),
        ));
    dd($leads);
    return view('welcome');
});

Route::get('/detox', function () {
    return view('detox');
});

Route::get('/eat-chill', function () {
    return view('eat-chill');
});

Route::post('/', 'OrderController@placeOrder');

Route::post('/cart', 'OrderController@placeCartOrder');

Route::get('/products', function () {
    return \App\Product::where('is_active',true)->get();
});

Route::get('/login', 'LoginController@show')->name('login')->middleware('guest');

Route::post('/login', 'LoginController@authenticate')->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/admin', 'AdminController@index')->name('admin');

    Route::get('/admin/create', 'AdminController@create')->name('create');
    Route::post('/admin/create', 'AdminController@store')->name('create.post');

    Route::get('/admin/{id}/edit', 'AdminController@edit')->name('edit');
    Route::post('/admin/{id}/edit', 'AdminController@update')->name('update');

    Route::post('/logout', 'LoginController@logout')->name('logout');
});

