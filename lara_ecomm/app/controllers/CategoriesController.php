<?php

class CategoriesController extends BaseController
{
  public function __construct() {

    // NASLEDJUJE OD BASECONTROLERA
    // bez ovoga ide overwrite
    // parent:: = php method, slicno postoji u js, ruby
    parent::__construct();

    // zastita od CSRF -> Cross-site request forgery
    $this->beforeFilter('csrf', array('on' => 'post'));
  }

  public function getIndex()
  {
    return View::make('categories.index')
      ->with('categories', Category::all());
  }

  public function postCreate()
  {
    $validator = Validator::make(Input::all(), Category::$rules);

    if ($validator->passes()) {
      $category = new Category;
      $category->name = Input::get('name');
      $category->save();

      return Redirect::to('admin/categories/index')
        ->with('message', 'Category Created');
    }

    // Validation failed
    return Redirect::to('admin/categories/index')
      ->with('message', 'Something went wrong')
      ->withErrors($validator)
      ->withInput();
  }

  public function postDestroy()
  {
    $category = Category::find(Input::get('id'));

    if ($category) {
      $category->delete();
      return Redirect::to('admin/categories/index')
        ->with('message', 'Category Deleted!');
    }

    // Didnt find category(id)
    return Redirect::to('admin/categories/index')
      ->with('message', 'Something went wrong, please try again.');
  }


}
