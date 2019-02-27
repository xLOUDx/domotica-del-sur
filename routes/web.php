<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/tienda', function () {
    return view('tienda');
});

Route::post('/redirect', 'WebPayController@redirect');
Route::post('/response', 'WebPayController@response');
Route::post('/finish', 'WebPayController@finish');
Route::get('/client', 'ClientController@getHome');
Route::post('/savesale', 'ProductController@saveSale');
Route::post('/sales', 'TransactionController@getSales');
Route::post('/details', 'ProductController@getDetails');

Route::post('/deletestock', 'ProductController@deleteStock');
Route::post('/stock', 'ProductController@getStock');
Route::post('/addstock', 'ProductController@addStock');
Route::post('/createuser', 'ClientController@createUser');
Route::get('/getclients', 'ClientController@getClients');
Route::post('/getclient', 'ClientController@getClient');
Route::post('/updateclient', 'ClientController@updateClient');
Route::post('/detailsclient', 'ClientController@detailsClient');
Route::post('/getshop', 'ProductController@getShop');
Route::post('/updatepass', 'ClientController@updatePass');

Route::post('/getseldata', 'ClientController@getselData');
Route::get('/getclients2', 'ClientController@getClients2');


Route::resource('/items', 'ProductController');
Route::resource('/transactions', 'TransactionController');
Route::resource('/clients', 'ClientController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
