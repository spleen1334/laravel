<?php

class UsersTableSeeder extends Seeder
{
  // Seedovi sluze za popunjavanje DB

  public function run()
  {
    $user = new User;
    $user->firstname = 'John';
    $user->lastname = 'Doe';
    $user->email = 'john@doe.com';
    $user->password = Hash::make('mypassword'); // CRYPT
    $user->telephone = '12341234';
    $user->admin = 1;
    $user->save();
  }

}
