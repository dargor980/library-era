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
Route::get('/stock/edit/{id}', 'StockController@edit')->name('editStock');

Route::get('/sales/list', 'SalesController@index')->name('listSales');
Route::get('/sales/getList', 'SalesController@getSales')->name('getSales');
Route::get('/sales/new', 'SalesController@create')->name('newSale');
Route::get('/sales/products-sale', 'SalesController@getSaleProducts');

//Sales
Route::post('/sales/new/create', 'SalesController@store');
Route::post('/sales/new/create/add-product', 'SalesController@addProductToSale');
Route::put('/sales/new/stock/update', 'SalesController@updateStock');
Route::post('/sales/complete', 'SalesController@completeSale');
Route::get('/sales/{id}/show', 'SalesController@show');

//Providers
Route::get('/providers/new', 'ProviderController@create')->name('newprovider');
Route::post('/providers/new/add', 'ProviderController@store')->name('addProvider');
Route::get('/providers', 'ProviderController@index')->name('providerlist');
Route::get('/providers/get-providers', 'ProviderController@getProviders')->name('getProviders');
Route::get('/providers/details/{id}', 'ProviderController@show')->name('detailProvider');
Route::get('/providers/edit/{id}', 'ProviderController@edit')->name('editProvider');
Route::get('/providers/delete/{id}', 'ProviderController@destroy')->name('deleteProvider');
Route::put('/providers/edit/{id}', 'ProviderController@update')->name('updateProvider');


//Dashboard
Route::get('/dashboard', 'DashboardController@index')->name("dashboard");

Route::group(['middleware' => 'admin'], function() {
    Route::get('/stock/new', 'StockController@show')->name('newStock');
   Route::put('/stock/new/update/{id}','StockController@update')->name('updatestock');

});
