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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel', 'HomeController@panel')->name('panel');



//Categories
Route::get('/product/category/new', 'CategoryController@create')->name('newCategory');
Route::post('/product/category/add','CategoryController@store')->name('addCategory');

//Products
Route::get('/products/list', 'ProductController@index')->name('productList');
Route::get('/products/get', 'ProductController@getProducts')->name('getProducts');
Route::get('/product/details/edit/{id}','ProductController@edit')->name('editProd');
Route::put('/product/edit/{id}','ProductController@update')->name('updateProd');
Route::get('/product/details/{id}', 'ProductController@show')->name('detailProd');
Route::get('/product/delete/{id}','ProductController@destroy')->name('deleteProd');

Route::get('/product/new', 'ProductController@create')->name('newProduct');
Route::post('/product/category/delete','CategoryController@destroy')->name('deleteCategory');
Route::post('/product/new/add','ProductController@store')->name('addproduct');

//Stock
Route::get('/stock/list', 'StockController@index')->name('listStock');
Route::get('/stock/getproducts', 'StockController@getStocks')->name('getStocks');

Route::get('/sales/list', 'SalesController@index')->name('listSales');
Route::get('/sales/getList', 'SalesController@getSales')->name('getSales');
Route::get('/sales/new', 'SalesController@create')->name('newSale');
Route::get('/sales/products-sale', 'SalesController@getSaleProducts');

Route::group(['middleware' => 'admin'], function() {
    Route::get('/stock/new', 'StockController@show')->name('newStock');
   Route::post('/stock/new/update','StockController@update')->name('updatestock');

});
