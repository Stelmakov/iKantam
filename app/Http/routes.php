<?php


Route::get('/', function () {
    return view('index');
});

Route::auth();

Route::get('/home', 'HomeController@index');
