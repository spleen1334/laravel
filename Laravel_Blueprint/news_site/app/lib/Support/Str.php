<?php namespace app\lib\Support;

// EXTENDOVANJE BUILTIN CLASSA
// lib/Support > zbog namespacinga
//
// app/config/app.php > i ovde je neophodno u CLASS ALIAS
// composer.json > AUTOLOAD sekcija
// Reload sa: composer dump-autoload

class Str extends \Illuminate\Support\Str
{
  public static function parse_feed($url)
  {
    // UCitaj XML (RSS FEED)
    $feed = simplexml_load_file($url);

    // Provera da li je uspelo ucitavanje
    // tj da li postoji URL
    if(!count($feed)) {
      return array();
    } else {
      $out = array();
      $items = $feed->channel->item;

      // Prebaci podatke u novi []
      for($i=0; $i<5; $i++) {
        $out[] = $items[$i];
      }

      return $out;
    }
  }
}
