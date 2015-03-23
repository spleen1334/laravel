<?php
class ProductsController extends BaseController
{
  public function __construct() {

    // NASLEDJUJE OD BASECONTROLERA
    // bez ovoga ide overwrite
    // parent:: = php method, slicno postoji u js, ruby
    parent::__construct();

    // zastita od CSRF -> Cross-site request forgery
    $this->beforeFilter('csrf', array('on' => 'post'));

    $this->beforeFilter('admin'); // AUTHENTIFICATION  FILTER
  }

  public function getIndex()
  {

    // Kreira novi []
    // u njemu su smestene sve kategorije
    $categories = [];
    foreach(Category::all() as $category) {
      $categories[$category->id] = $category->name;
    }

    return View::make('products.index')
      ->with('products', Product::all())
      ->with('categories', $categories);
  }

  public function postCreate()
  {
    $validator = Validator::make(Input::all(), Product::$rules);

    if ($validator->passes()) {
      $product = new Product;

      $product->category_id = Input::get('category_id'); // povezivanje sa category
      $product->title = Input::get('title');
      $product->description = Input::get('description');
      $product->price = Input::get('price');

      // IMAGE FAJL
      // getClient... > laravel File requests
      $image = Input::file('image');
      $filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();
      Image::make($image->getRealPath())->resize(468, 249)->save('public/img/products/'.$filename);
      $product->image = 'img/products/'.$filename;

      $product->save();

      return Redirect::to('admin/products/index')
        ->with('message', 'Product Created');
    }

    // Validation failed
    return Redirect::to('admin/products/index')
      ->with('message', 'Something went wrong')
      ->withErrors($validator)
      ->withInput();
  }

  public function postDestroy()
  {
    $product = Product::find(Input::get('id'));

    if ($product) {
      // Obrisi fajl
      File::delete('public/'.$product->image);

      $product->delete();
      return Redirect::to('admin/products/index')
        ->with('message', 'Product Deleted!');
    }

    // Didnt find category(id)
    return Redirect::to('admin/products/index')
      ->with('message', 'Something went wrong, please try again.');
  }


  // Update dostupnost nekog proizvoda
  // toggle-availability = generisana route
  public function postToggleAvailability()
  {
    $product = Product::find(Input::get('id'));

    if ($product) {
      $product->availability = Input::get('availability');
      $product->save();

      return Redirect::to('admin/products/index')
        ->with('message', 'Product updated');
    }

    // Failed
    return Redirect::to('admin/products/index')
      ->with('message', 'Invalid product');
  }





}
