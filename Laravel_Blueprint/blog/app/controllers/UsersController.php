<?php

class UsersController extends BaseController
{

  public function postLogin()
  {
    # Method attempt koristimo za login usera
    Auth::attempt(array(
      'email' => Input::get('email'),
      'password' => Input::get('password')
    ));

    # Alternativa:
    # $user = User::find(1);
    # Auth::login($user);

    return Redirect::route('add_new_post');
  }

  public function getLogout()
  {
    # Logout vrlo prosto
    Auth::logout();
    return Redirect::route('index');
  }


}
