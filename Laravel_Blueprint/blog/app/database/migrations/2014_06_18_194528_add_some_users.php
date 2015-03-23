<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeUsers extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    // Ovu migracuju koristimo samo za ubacivanje test usera u db
    // KORISTE SE SEEDERI A NE MIGRACIJE ZA generisanje podataka
    User::create(array(
      'email'    => 'test@mail.com',
      'password' => Hash::make('password'),
      'name'     => 'John Doe'
    ));
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    //
  }

}
