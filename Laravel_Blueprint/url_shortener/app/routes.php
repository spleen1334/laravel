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

Route::get('/', function()
{
  return View::make('form');
});

// Post za saving to db
Route::post('/', function()
  {
    // FORM VALIDATION
    $rules = array(
      // Format validacije
      'link' => 'required|url'
    );

    // Ovo pokrece validaciju, automatski escapuje itd..
    // Validator...(sta se validira, sa cime)
    $validation = Validator::make(Input::all(), $rules);

    // Ukoliko ne prodje validacija redirect sa Errors ka root
    // With se odnosi na SESSION
    // withInput() = ovo su stare postovane vrednosti, tako da elementi ostaju
    // popunjeni
    if($validation->fails()) {
      return Redirect::to('/')
        ->withInput()
        ->withErrors($validation);
    } else {
      // Provera da li vec postoji link u db
      // Ovo je SQL query, Input = input box iz view ('link')
      $link = Link::where('url', '=', Input::get('link'))
        ->first();

      // Ukoliko postoji vrati nazad na view
      // sa with, link se vezuje za hash iz db
      if($link) {
        return Redirect::to('/')
          ->withInput()
          ->with('link', $link->hash);
      } else {
        // Unique hash create
        do {
          // generisi random string od 6 char
          $newHash = Str::random(6);
          // ovo je za duplikate, ukoliko postoji generisi novi hash
          // kao neka sigurnosna provera da se slucajno ne zadesi da se
          // generisu iste vrednosti vise puta
        } while (Link::where('hash', '=', $newHash)->count() > 0);

        // Novi unos u db
        Link::create(array(
          'url' => Input::get('link'),
          'hash' => $newHash
        ));

        // Redirekt to root
        // link = novi hash
        return Redirect::to('/')
          ->withInput()
          ->with('link', $newHash);
      }
    }
  });

// {} oznacava parametar
Route::get('{hash}', function($hash) {
  // Provera da li postoji hash-link u db
  $link = Link::where('hash', '=', $hash)
    ->first();


  if($link) {
    // Ukoliko postoji redirect na taj link iz db, odnosno na novu stranu
    return Redirect::to($link->url);
  } else {
    // Ukoliko ne vrati na root
    return Redirect::to('/')
      ->with('message', 'Invalid Link');
  }
  // ovde se vrsi neka vrsta validacije za {hash}, odnosno za LINK parametar
  // drugi parametar je regex koji filtrira hash
})->where('hash', '[0-9a-zA-Z]{6}');
