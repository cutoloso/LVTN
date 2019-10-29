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

//HomeController
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::prefix('api')->group(function (){
    Route::post('/getProductByCategory','HomeController@getProductByCategory');
});
Route::get('single/{id}', 'HomeController@getSingle')->name('get-single');
Route::get('/dddd-{brand}', 'HomeController@getProductByBrand');
Route::get('checkout', 'HomeController@getCheckOut')->name('get-checkout')->middleware('auth');
Route::get('payment/{option}', 'HomeController@getPayment')->name('get-payment')->middleware('auth');

Route::get('get-region','HomeController@getRegion')->name('get-region');
Route::get('get-city/{matp}','HomeController@getCity')->name('get-city');
Route::get('get-ward/{maqh}','HomeController@getWard')->name('get-ward');

//CartController
Route::post('add-to-cart/{id}', 'CartController@addToCart')->name('add-to-cart');
Route::get('buy-now/{id}', 'CartController@buyNow')->name('buy-now');
Route::get('cart', 'CartController@getCart')->name('get-cart');
Route::get('empty-cart', 'CartController@emptyCart')->name('empty-cart');
Route::get('del-cart-item/{rowId}', 'CartController@deleteCartItem')->name('delete-cart-item');
Route::put('update-cart-item/{rowId}', 'CartController@updateCartItem')->name('update-cart-item');

//CustommerController
Route::put('customer/{userId}', 'CustomerController@update')->name('customer.update');

//Order
Route::post('order','OrderController@store')->name('order.store');

//Review
Route::get('review','ReviewController@index')->name('review.index');
Route::get('review-filter','ReviewController@filter');
Route::get('review-count/{star}','ReviewController@count')->name('review.count');
Route::post('review','ReviewController@store')->name('review.store');

//Compare
Route::get('compare/{pro1}-vs-{pro2}','HomeController@getCompare')->name('get.compare');

//Search
Route::post('search','HomeController@search')->name('search');

Route::get('category','HomeController@filter')->name('filter');
//Route::get('category/{brand}/','HomeController@filter')->name('filter-brand');


Auth::routes();


Route::get('user/account','UserController@account')->name('user.account');
Route::put('user/account','UserController@update')->name('user.update');
Route::get('user/order','UserController@getOrder')->name('user.order');
Route::get('user/order/{id}','UserController@getOrderDetail')->name('user.orderShow');
Route::get('user/review','UserController@getReview')->name('user.review');
Route::get('api/review/{pro_id}', 'HomeController@getReview');


Route::get('test/{id}','OrderController@sendMail');
