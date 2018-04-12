<?php


Route::get('/', 'IndexController@index');
Route::get('/articles', 'IndexController@index');

Route::auth();


Route::get('/add-article','ArticleController@addArticle')->middleware('auth');
Route::post('/add-article','ArticleController@addArticle')->middleware('auth');

Route::get('/edit-article/{slug}','ArticleController@editArticle')->middleware('hasArticle');
Route::post('/edit-article/{slug}','ArticleController@editArticle')->middleware('hasArticle');

Route::get('/articles/{slug}','ArticleController@showArticle');
Route::post('/articles/{slug}','ArticleController@showArticle')->middleware('auth');

Route::post('/article/delete','ArticleController@deleteArticle')->middleware('hasArticle');


Route::post('/comments/delete','CommentController@delete')->middleware('hasComment');
Route::post('/comments/edit','CommentController@edit')->middleware('hasComment');



