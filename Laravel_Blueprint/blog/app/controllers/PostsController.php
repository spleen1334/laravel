<?php

class PostsController extends BaseController
{
  public function getIndex()
  {
    # WITH SE ODNOSI NA AUTHOR()
    # sa with se pozivaju relacione funkcije
    #
    # to je f() kojom se vezujemo za User model
    # belongsTo, odnosi se na author_id POLJE u tabeli posts
    #
    #  $post->Author->name >> na osnovu author_id iz posts pronalazi
    #  odgovarajuceg Usera iz users tabele, i tako mozemo da pristupa
    #  poljima iz users tabele koji se odnose samo na onog iz post(author_id)
    // $posts = Post::with('Author')->orderBy('id', 'DESC')->get();
    $posts = Post::with('Author')->orderBy('id', 'DESC')->paginate(5); // PAGINATE umesto get()


    return View::make('index')
      ->with('posts', $posts);
  }

  public function getAdmin()
  {
    return View::make('addpost');
  }

  public function postAdd()
  {
    Post::create(array(
      'title'     => Input::get('title'),
      'content'   => Input::get('content'),
      'author_id' => Auth::user()->id # trenutno logovan user
    ));

    return Redirect::route('index');
  }



}
