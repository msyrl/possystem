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

Route::get('/', 'DashboardController@index')->name('dashboard.index');

Route::resource('/vendor', 'VendorController');
Route::get('/api/vendor', 'VendorController@vendorApi')->name('vendor.api');

Route::resource('/good_category', 'GoodCategoryController');
Route::get('/api/good_category', 'GoodCategoryController@goodCategoryApi')->name('good_category.api');

Route::resource('/good', 'GoodController');
Route::get('/api/good', 'GoodController@goodApi')->name('good.api');

Route::resource('/buy', 'BuyController')->except([
	'edit', 'update', 'destroy',
]);
Route::get('/buy/api/vendor', 'BuyController@apiVendor')->name('buy.api.vendor');
Route::get('/buy/api/good', 'BuyController@apiGood')->name('buy.api.good');
Route::post('/buy/get_goods', 'BuyController@getVendorGoods')->name('buy.getVendorGoods');
Route::post('/buy/get_good', 'BuyController@getGood')->name('buy.getGood');
Route::post('/buy/cart', 'BuyController@cart')->name('buy.cart');
Route::get('/api/buy', 'BuyController@buyApi')->name('buy.api');

Route::resource('/sale', 'SaleController')->except([
	'edit', 'update', 'destroy',
]);
Route::post('/sale/cart', 'SaleController@cart')->name('sale.cart');
Route::get('/api/sale', 'SaleController@saleApi')->name('sale.api');

Route::prefix('report')->name('report.')->group(function () {
	Route::get('/stock', 'ReportController@stock')->name('stock');
	Route::get('/stock/api', 'ReportController@apiStock')->name('stock.api');
	Route::get('/buy', 'ReportController@buy')->name('buy');
	Route::get('/buy/api', 'ReportController@apiBuy')->name('buy.api');
	Route::get('/sale', 'ReportController@sale')->name('sale');
	Route::get('/sale/api', 'ReportController@apiSale')->name('sale.api');
	Route::get('/transaction', 'ReportController@transaction')->name('transaction');
	Route::get('/transaction/api', 'ReportController@apiTransaction')->name('transaction.api');
});