<?php
class StoreController extends BaseController
{
  // Ovaj kontroler se odnosi na prikaz sajta kupcima

  public function __construct()
  {

    // NASLEDJUJE OD BASECONTROLERA
    // bez ovoga ide overwrite
    // parent:: = php method, slicno postoji u js, ruby
    parent::__construct();

    // CSRF zastita, na svaki post
    $this->beforeFilter('csrf', array('on'=>'post'));

    // Filter auth, koristicemo ga za adrese iz array
    // only = limitira samo na odredje route a ne na sve route iz kontrolera
    $this->beforeFilter('auth', array('only' => array(
      'postAddtocart', 'getCart', 'getRemoveitem'
    )));
  }

  public function getIndex()
  {
    return View::make('store.index')
      ->with('products', Product::take(4)->orderBy('created_at', 'DESC')->get());
    // take = uzima 4, slicno sto i limit 4
  }

  public function getView($id)
  {
    return View::make('store.view')
      ->with('product', Product::find($id));
  }


  // Selektuj odgovarajucu kategoriju
  public function getCategory($cat_id)
  {
    return View::make('store.category')
      ->with('products', Product::where('category_id', '=', $cat_id)->paginate(6) )
      ->with('category', Category::find($cat_id));
  }


  // PRETRAGA
  public function getSearch()
  {
    $keyword = Input::get('keyword');

    return View::make('store.search')
      // %keyword% = partial search
      ->with('products', Product::where('title', 'LIKE', '%'.$keyword.'%')->get() )
      ->with('keyword', $keyword);
  }


  // CART


  // ADD TO CART
  public function postAddtocart()
  {
    $product = Product::find(Input::get('id'));
    $quantity = Input::get('quantity');

    // Dodaj iteme u Cart (plugin)
    Cart::insert(array(
      'id'       => $product->id,
      'name'     => $product->title,
      'price'    => $product->price,
      'quantity' => $quantity,
      'image'    => $product->image,
    ));

    return Redirect::to('store/cart');
  }


  // UZMI SADRZAJ KORPE I UCITAJ VIEW
  public function getCart()
  {
    return View::make('store.cart')
      ->with('products', Cart::contents());
  }

  // REMOVE ITEM, id
  // 'identifier' => 'cookie', //cookie, requestcookie
  // identifier = posebno generisan cookie od strane plugina
  public function getRemoveitems($identifier)
  {
    $item = Cart::item($identifier);
    $item->remove();

    return Redirect::to('store/cart');
  }


  // CONTACT PAGE
  public function getContact()
  {
    return View::make('store.contact');
  }







}
