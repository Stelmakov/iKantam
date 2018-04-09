<?php


Route::get('/', 'IndexController@index');
Route::get('/articles', 'IndexController@index');

Route::auth();


Route::get('/add-article','ArticleController@addArticle')->middleware('isWriter');
Route::post('/add-article','ArticleController@addArticle')->middleware('isWriter');

Route::get('/edit-article/{slug}','ArticleController@editArticle')->middleware('isWriter');
Route::post('/edit-article/{slug}','ArticleController@editArticle')->middleware('isWriter');

Route::get('/articles/{slug}','ArticleController@showArticle');
Route::post('/articles/{slug}','ArticleController@showArticle')->middleware('auth');


Route::post('/comments/delete','CommentController@delete')->middleware('isWriter');
Route::post('/comments/edit','CommentController@edit')->middleware('isWriter');


