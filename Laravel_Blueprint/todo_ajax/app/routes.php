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


// CTRL je restful
// trebalo bi da se automatski generisu linkovi
// npr /todo
// mozda treba pun naziv TodoController
Route::controller('/', 'todo');

// Route::controller('todo');
// Ovo automatski registruje /todo path na TodoController
// sto znaci da ukoliko ne dostavimo 1st parametar laravel
// automatski vezuje route za /todo

// Ukoliko zelimo da automatski ucitamo sve dostupne kontrolere
// bez ikakvih dodatnih podesavanja:
// Route::controller(Controller::detect());
