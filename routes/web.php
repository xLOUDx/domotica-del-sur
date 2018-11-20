<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/blog-details', function () {
    return view('blog-details');
});

Route::get('/prueba', 'WebPayController@index');
Route::get('/pay', 'WebPayController@pay');

