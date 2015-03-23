<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('images', function(Blueprint $table)
    {
      $table->increments('id')->unsigned();

      $table->integer('album_id')->unsigned();

      $table->string('image');
      $table->string('description');

      // Foreign = povezivanje 2 tabele (sql)
      // albums je glavna tabela i ovo omogucava da kad se
      // npr obrise neki album row, da se auto brisu i sve povezane slike
      $table->foreign('album_id')
        ->references('id')->on('albums')
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->increments('id');
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
    Schema::drop('images');
  }

}
