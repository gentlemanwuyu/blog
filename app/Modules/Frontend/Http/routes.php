<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['as' => 'index.'], function() {
	Route::get('/', ['as'=>'index', 'uses'=>'IndexController@index']);
	Route::get('/about.html', ['as'=>'about', 'uses'=>'IndexController@about']);
	Route::get('/search.html', ['as'=>'search', 'uses'=>'IndexController@search']);
});

Route::group(['prefix' => 'article', 'as' => 'article.'], function() {
	Route::get('/{id}.html', ['as'=>'detail', 'uses'=>'ArticleController@detail']);
	Route::post('/paginate', ['as'=>'paginate', 'uses'=>'ArticleController@paginate']);
});

Route::group(['prefix' => 'comment', 'as' => 'comment.'], function() {
	Route::post('/paginate', ['as'=>'paginate', 'uses'=>'CommentController@paginate']);
	Route::post('/create_comment', ['as'=>'create_comment', 'uses'=>'CommentController@createComment']);
});

Route::group(['prefix' => 'section', 'as' => 'section.'], function() {
	Route::get('/{id}.html', ['as'=>'index', 'uses'=>'SectionController@index']);
});

Route::group(['prefix' => 'category', 'as' => 'category.'], function() {
	Route::get('/{id}.html', ['as'=>'index', 'uses'=>'CategoryController@index']);
});

Route::group(['prefix' => 'label', 'as' => 'label.'], function() {
	Route::get('/{id}.html', ['as'=>'index', 'uses'=>'LabelController@index']);
});