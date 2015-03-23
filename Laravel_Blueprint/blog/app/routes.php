<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

# ROOT
Route::get('/', array('as' => 'index', 'uses' => 'PostsController@getIndex'));

# ADMIN / ADD POSTS
Route::get('/admin', array('as' => 'admin_area', 'uses' => 'PostsController@getAdmin'));
Route::get('/add', array('as' => 'add_new_post', 'uses' => 'PostsController@postAdd'));

# LOGIN / LOGOUT
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@postLogin'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UserController@getLogout'));
