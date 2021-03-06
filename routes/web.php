<?php

use App\order;

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

Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products/search', 'ProductController@search')->name('products.search');
Route::resource('products', 'ProductController');

Route::get('/add_to_cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');
Route::get('/cart/update/{rowId}', 'CartController@update')->name('cart.update')->middleware('auth');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
Route::get('/cart/apply-coupon', 'CartController@applyCoupon')->name('cart.coupon')->middleware('auth');

Route::resource('orders', 'OrderController')->middleware('auth');

// Route::get('paypal/checkout', 'PayPalController@getExpressCheckout');
// Route::get('paypal/checkout-success', 'PayPalController@getExpressCheckoutSuccess');

Route::resource('shops', 'ShopController')->middleware('auth');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('/test', function () {
    $o = order::find(2);

    $o->generateSubOrders();
});
