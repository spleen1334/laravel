<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SqlMigracija extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('photos', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('title', 400)->default(''); // title
      $table->string('image', 400)->default(''); // img filename
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('photos');
  }

}
