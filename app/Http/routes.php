<?php


Route::get('/', 'IndexController@index');
Route::get('/articles', 'IndexController@index');

Route::auth();


Route::get('/add-article','ArticleController@addArticle')->middleware('auth', 'hasArticle');
Route::post('/add-article','ArticleController@addArticle')->middleware('auth', 'hasArticle');

Route::get('/edit-article/{slug}','ArticleController@editArticle')->middleware('auth', 'hasArticle');
Route::post('/edit-article/{slug}','ArticleController@editArticle')->middleware('auth', 'hasArticle');

Route::get('/articles/{slug}','ArticleController@showArticle');
Route::post('/articles/{slug}','ArticleController@showArticle')->middleware('auth');

Route::post('/article/delete','ArticleController@deleteArticle')->middleware('auth', 'hasArticle');


Route::post('/comments/delete','CommentController@delete')->middleware('auth', 'hasArticle');
Route::post('/comments/edit','CommentController@edit')->middleware('auth', 'hasArticle');



