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

Route::get('/', ['as'=>'index', 'uses'=>'IndexController@index']);
Route::get('/login', ['as'=>'login_page', 'uses'=>'IndexController@loginPage']);
Route::post('/login', ['as'=>'login', 'uses'=>'IndexController@login']);
