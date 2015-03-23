<?php

class AlbumsController extends BaseController
{
  public function getList()
  {
    // with = eager loading?
    $albums = Album::with('Photos')->get();

    return View::make('index')
      ->with('albums', $albums);
  }


  public function getAlbum($id)
  {
    $album = Album::with('Photos')->find($id);

    return View::make('album')
      ->with('album', $album);
  }


  public function getForm()
  {
    return View::make('index');
  }


  public function postCreate()
  {
    $rules = array(
      'name'        => 'required',
      'cover_image' => 'required|image'
    );

    $validator = Validator::make(Input::all(), $rules);

    if($validator->fails()) {
      return Redirect::route('create_album_form')
        ->withErrors($validator)
        ->withInput();
    }

    /* FILE UPLOAD */
    $file = Input::file('cover_image');
    $random_name = str_random(8);
    $destinationPath = 'albums/';
    $extension = $file->getClientOriginalExtension();

    /* Filename generation */
    $filename = $random_name.'_cover'.$extension;


    /* Izvrsi premestanje uploadovanog file-a */
    $uploadSuccess = Input::file('cover_image')
      ->move($destinationPath, $filename);

    /* Ubaci novu sliku (fajl) u DB */
    $album = Album::create(array(
      'name' => Input::get('name'),
      'description' => Input::get('description'),
      'cover_image' => $filename
    ));

    return Redirect::route('show_album', array('id' => $album->id));
  }


  public function getDelete($id)
  {
    $album = Album::find($id);
    $album->delete();

    return Redirect::route('index');
  }
}
