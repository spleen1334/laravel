<?php

class DatabaseSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Eloquent::unguard();

    // Ovo se koristi, naziv je isti kao i file za seed
    $this->call('UsersTableSeeder');
  }

}
