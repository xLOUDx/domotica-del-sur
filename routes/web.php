<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/tienda', function () {
    return view('tienda');
});

Route::get('/blog-details', function () {
    return view('blog-details');
});

Route::get('/prueba', 'WebPayController@index');
Route::get('/redirect', 'WebPayController@redirect');
Route::post('/response', 'WebPayController@response');
Route::post('/finish', 'WebPayController@finish');



