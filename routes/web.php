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

use Gloudemans\Shoppingcart\Facades\Cart;
//Shop
Route::get('/', 'HomeController@index')->name('home');
Route::get('/catalog', 'CatalogController@index')->name('catalog.index');
Route::get('/catalog/{product}', 'CatalogController@show')->name('catalog.show');

//Cart
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/{product}', 'CartController@store')->name('cart.add');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::get('/cart/empty', 'CartController@emptyCart')->name('cart.empty');

//WishList
Route::post('/wishList/{product}', 'WishListController@addToWishList')->name('addToWishList');
Route::delete('/wishList/{product}', 'WishListController@destroy')->name('wishList.destroy');
Route::post('/wishList/switch-to-cart/{product}', 'WishListController@switchToCart')->name('wishList.switchToCart');

//Checkout
Route::get('/checkout', 'CheckoutController@index')->name('checkout')->middleware('auth');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/thank-you', 'ConfirmationController@index')->name('confirmation.index');

//GuestCheckout
Route::get('/guest-checkout', 'CheckoutController@index')->name('guestCheckout');

//Coupons
Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');
//Voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Auth::routes();

//User dashboard
Route::middleware('auth')->group(function () {
    Route::get('/profile', 'UsersController@edit')->name('users.edit');
    Route::patch('/profile', 'UsersController@update')->name('users.update');
    Route::get('/my-orders', 'OrdersController@index')->name('my-orders');
    Route::get('/wishlist', 'WishListController@index')->name('wishlist');
});
Route::get('/mailable', function () {
    $order = App\Entity\Order\Order::all()->first();
    return new \App\Mail\OrderStatusInPvz($order);
});
