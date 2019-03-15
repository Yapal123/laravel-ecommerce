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

Route::get('/', function () {
    return view('client.index');
});
Route::get('/', 'ClientController@index')->name('index');


Auth::routes();
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@login']);




Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{category}/show', 'ClientController@products')->name('products');
Route::post('/products/{category}/show', 'ClientController@products')->name('products');



Route::get('/products/{category}/{props}/props', 'ClientController@filtredProducts')->name('filtredProducts');

Route::get('/login', 'ClientController@loginPage')->name('loginPage');

Route::get('/product/{id}/singleProduct', 'ClientController@singleProduct')->name('single');

Route::get('admin/add', 'AdminController@add')->name('add')->middleware('admin');
Route::post('admin/store','AdminController@store')->name('store');

Route::get('/cart','ClientController@cartShow')->name('cart');

Route::get('add-to-cart/{id}', 'ClientController@addToCart')->name('addToCart');

Route::patch('update-cart', 'ClientController@update');
 
Route::delete('remove-from-cart', 'ClientController@remove');

Route::get('/purchase','ClientController@purchase')->name('purchase');

Route::post('/order','ClientController@order')->name('order');

Route::get('/thanks','ClientController@thx')->name('thx');

Route::get('admin/allItems','AdminController@allItems')->name('allItems');

Route::post('admin/delete/{id}','AdminController@deleteItem')->name('deleteItem');

Route::get('admin/editItem/{id}','AdminController@editItem')->name('editItem');

Route::post('admin/update','AdminController@updateItem')->name('updateItem');

Route::get('admin/allOrders', 'AdminController@allOrders')->name('allOrders');

Route::get('admin/singleOrder/{id}','AdminController@singleOrder')->name('singleOrder');

Route::get('admin/editOrder/{id}','AdminController@editOrder')->name('editOrder');

Route::post('admin/updateOrder','AdminController@updateOrder')->name('updateOrder');

Route::post('product/{id}/postComment','ClientController@postComment')->name('postComment');

Route::get('/aboutUs','ClientController@aboutUs')->name('about');

Route::get('/search','ClientController@search')->name('search');





