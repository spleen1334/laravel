<?php

class BaseController extends Controller {

  // DODATO
  // Dodali smo beforeFIlter u konstrukotor
  // da bi svi ostali konstrukotri mogli da naslede taj filter
  // On se odnosi na navigaciju po kategorijama
  //
  // Filteri mogu da se definisu uokviru routes ili kod samih kontrolera
  //
  // View::share = deli odredjene podatke SVIM views
  public function __construct()
  {
    $this->beforeFilter(function() {
      View::share('catnav', Category::all());
    });
  }


  /**
   * Setup the layout used by the controller.
   *
   * @return void
   */
  protected function setupLayout()
  {
    if ( ! is_null($this->layout))
    {
      $this->layout = View::make($this->layout);
    }
  }

}
