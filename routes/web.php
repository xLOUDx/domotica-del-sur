<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/tienda', function () {
    return view('tienda');
});

Route::post('/redirect', 'WebPayController@redirect');

Route::get('/prueba', 'WebPayController@index');
//Route::get('/redirect', 'WebPayController@redirect');
Route::post('/response', 'WebPayController@response');
Route::post('/finish', 'WebPayController@finish');

Route::resource('/items', 'ProductController');



