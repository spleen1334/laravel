<?php

class userscontroller extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->beforeFilter('csrf', array('on'=>'post'));

    $this->beforeFilter('admin'); // AUTHENTIFICATION  FILTER
  }

  // Kreiraj novi User account strana
  public function getNewaccount()
  {
    return View::make('users.newaccount');
  }

  // Kreiraj novog usera
  public function postCreate()
  {
    $validator = Validator::make(Input::all(), User::$rules);

    if ($validator->passes()) {
      $user = new User;
      $user->firstname = Input::get('firstname');
      $user->lastname = Input::get('lastname');
      $user->email = Hash::make(Input::get('email'));
      $user->password = Input::get('password');
      $user->telephone = Input::get('telephone');
      $user->save();

      return Redirect::to('users/signin')
        ->with('message', 'Thank you for registering');
    }

    // Failed
    return Redirect::to('users/newaccount')
      ->with('message', 'Something went wrong')
      ->withErrors($validator)
      ->withInput();
  }


  // LOGIN strana
  public function getSignin()
  {
    return View::make('users.signin');
  }


  // LOGIN Submit
  public function postSingin()
    // Auth::attempt = laravel, uporedjuje odgovarajuca polja sa db
  {
    if(Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
      return Redirect::to('/')->with('message', 'Thanks for signing in');
    }

    // NIJE PROSLA VERIFIKACIJA AUTH
    return Redirect::to('users/signin')
      ->with('message', 'Your email/password combo was incorrect');
  }


  // LOGOUT
  public function getSignout()
  {
    Auth::logout(); // LARAVEL builtin

    return Redirect::to('users/signin')
      ->with('message', 'You have been signed out');
  }






}
