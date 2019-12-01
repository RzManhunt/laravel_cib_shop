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

Route::get('/', 'MainController@index')->name('main');

Route::get('/comprar/{category?}', 'ShopController@index')->name('shop.index');

Route::get('/detalle/{slug}', 'ShopController@show')->name('shop.show');

Route::get('/carro', 'CartController@index')->name('cart.index');
Route::put('/carro/add', 'CartController@store')->name('cart.store');
Route::delete('/carro/remove', 'CartController@remove')->name('cart.remove');
Route::post('/pedido', 'CheckoutController@index')->name('checkout.index');


Route::view('/gracias', 'thanks');
Route::patch('/carro/{product_id}', 'CartController@update')->name('cart.update');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
