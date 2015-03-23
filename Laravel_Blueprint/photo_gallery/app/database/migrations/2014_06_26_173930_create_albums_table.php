<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('albums', function(Blueprint $table)
    {
      // Note: When creating a foreign key that references an incrementing
      // integer, remember to always make the foreign key column unsigned.
      $table->increments('id')->unsigned();;

      $table->string('name');
      $table->text('description');
      $table->string('cover_image');
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
    Schema::drop('albums');
  }

}
