<?php


Route::get('/', 'IndexController@index');

Route::auth();


Route::get('/add-article','ArticleController@addArticle')->middleware('isWriter');
Route::post('/add-article','ArticleController@addArticle')->middleware('isWriter');

Route::get('/edit-article/{slug}','ArticleController@editArticle')->middleware('isWriter');
Route::post('/edit-article/{slug}','ArticleController@editArticle')->middleware('isWriter');


