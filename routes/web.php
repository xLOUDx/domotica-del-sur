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

Route::resource('/items', 'ProductController');
Route::resource('/transactions', 'TransactionController');

Route::post('/poto', 'ProductController@poto');
Route::post('/algo', 'ProductController@algo');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
