<?php

class FeedsController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    # knjiga: getIndex


    // Ucitavanje iz DB
    // WHERE je ovde dat sa dinamickom syntaxom
    // Alternativa = ..where('active', '1')

    // Uzmi sve feedove iz sledecih kategorija
    $news_raw = Feeds::whereActive(1)->whereCategory('News')->get();
    $sports_raw = Feeds::whereActive(1)->whereCategory('Sports')->get();
    $technology_raw = Feeds::whereActive(1)->whereCategory('Technology')->get();

    // Moze bolje da se napravi View
    // Trenutno se sve trpa na jednu stranu i ima mnogo ponavljajuceg koda
    // Moguca alternativa je da se prosledi array: feeds['news']...
    // I da se prodje kroz taj array i ucita PARTIAL (sa render('_ime_partial'))
    return View::make('index')
      ->with('news', $news_raw)
      ->with('sports', $sports_raw)
      ->with('technology', $technology_raw);

  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    # knjiga: getCreate
    return View::make('create_feed');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    # knjiga: postCreate
    $validation = Validation::make(Input::all(), Feeds::$form_rules);

    if($validation->passes()) {

      $create = Feeds::create(array(
        'feed' => Input::get('feed'),
        'title' => Input::get('title'),
        'active' => Input::get('active'),
        'category' => Input::get('category'),
      ));

      if ($create) {
        return Redirect::to('feeds/create')
          ->with('message', 'The feed was successfully created!');
      } else {
        return Redirect::to('feeds/create')
          ->withInput()
          ->with('message', 'The feed failed to create.');
      }
    } else {
      // VALIDATION FAIL
      return Redirect::to('feeds/create')
        ->withInput()
        ->with('message', $validation->errors()->first());
    }
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    //
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    //
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }


}
