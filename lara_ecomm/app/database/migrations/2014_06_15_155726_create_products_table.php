<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function($table){

      $table->increments('id');

      // Ovo je iz laravel doc, da bi laravel mogao da napravi
      // foreign key vrednost mora da bude unsignedInteger!!!
      // $table->integer('category_id');
      $table->unsignedInteger('category_id');

      // Foreign key = povezivanje sa categories table
      $table->foreign('category_id')->references('id')->on('categories');

      $table->string('title');
      $table->text('description');
      // naziv, boj cifara, decimalna mesta >> price, 123456.00
      $table->decimal('price', 6, 2);

      $table->boolean('availability')->default(1);
      $table->string('image');
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
    Schema::drop('products');
  }

}
