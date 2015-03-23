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


// Route::[tip_http]('url', array('as' => 'namedRoute', 'uses' => 'Controlername@method'))

// Index
Route::get('/', array('as' => 'index_page', 'uses' =>'ImageController@getIndex'));

// Post slike
Route::post('/', array('as' => 'index_page_post', 'before' => 'csrf', 'uses' =>'ImageController@postIndex'));

// Pojedinacna slika
Route::get('snatch/{id}',
  array('as' => 'get_image_information', 'uses' => "ImageController@getSnatch"))
  ->where('id', '[0-9]+'); // Regexp filter

// Galeri, sve slike
Route::get('all', array('as' => 'all_images', 'uses' => 'ImageController@getAll'));

// Delete
Route::get('delete/{id}', array('as' => 'delete_image', 'uses'=>'ImageController@getDelete'))
  ->where('id', '[0-9]+');
