<?php

class UserTableSeeder extends DatabaseSeeder
{
  public function run()
  {
    User::create(array(
      'email' => 'testera@kkk.com',
      'password' => Hash::make('password'),
      'name' => 'Mica Ambient'
    ));
  }
}
