<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/tienda', function () {
    return view('tienda');
});

Route::post('/redirect', 'WebPayController@redirect');
Route::get('/prueba', 'WebPayController@index');
Route::post('/response', 'WebPayController@response');
Route::post('/finish', 'WebPayController@finish');

Route::resource('/items', 'ProductController');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
