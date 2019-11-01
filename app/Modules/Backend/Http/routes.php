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

Route::get('/', ['middleware' => ['auth'], 'as'=>'index', 'uses'=>'IndexController@index']);
Route::get('login', ['as'=>'login_page', 'uses'=>'IndexController@loginPage']);
Route::post('login', ['as'=>'login', 'uses'=>'IndexController@login']);
Route::get('logout', ['middleware' => ['auth'], 'as'=>'logout', 'uses'=>'IndexController@logout']);

// 分类控制器
Route::group(['middleware'=>['auth'], 'prefix'=>'category', 'as'=>'category.'], function (){
    Route::get('list', ['as'=>'list', 'uses'=>'CategoryController@getList']);
    Route::get('get_tree', ['as'=>'get_tree', 'uses'=>'CategoryController@getTree']);
    Route::post('create_or_update_category', ['as'=>'create_or_update_category', 'uses'=>'CategoryController@createOrUpdateCategory']);
    Route::post('delete_category', ['as'=>'delete_category', 'uses'=>'CategoryController@deleteCategory']);
});

// 标签控制器
Route::group(['middleware'=>['auth'], 'prefix'=>'label', 'as'=>'label.'], function (){
    Route::get('list', ['as'=>'list', 'uses'=>'LabelController@getList']);
    Route::get('paginate', ['as'=>'paginate', 'uses'=>'LabelController@paginate']);
    Route::post('create_or_update_label', ['as'=>'create_or_update_label', 'uses'=>'LabelController@createOrUpdateLabel']);
    Route::post('delete_label', ['as'=>'delete_label', 'uses'=>'LabelController@deleteLabel']);
});