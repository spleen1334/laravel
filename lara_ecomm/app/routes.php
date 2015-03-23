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

// ROOT
Route::get('/', array('uses'=>'StoreController@getIndex'));

// ADMIN
Route::controller('admin/categories', 'CategoriesController');
Route::controller('admin/products', 'ProductsController');

// PUB
Route::controller('store', 'StoreController');

// USERS: login/out
Route::controller('users', 'UsersController');
