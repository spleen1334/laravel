<?php

// HELPER METHODE
// Ovo smo definisali zbog availability producta
//
// Mora da se aktivira u laravelu:
// app/start/global.php >> Class Loader sekcija >> app_path().'/libs'

class Availability
{
  // Stanje proizvoda
  public static function display($availability)
  {
    if($availability == 0) {
      echo "Out of Stock";
    } else if ($availability == 1) {
      echo "In Stock";
    }
  }

  // HTML Klase
  public static function displayClass($availability)
  {
    if($availability == 0) {
      echo "outofstock";
    } else if ($availability == 1) {
      echo "instock";
    }
  }
}
