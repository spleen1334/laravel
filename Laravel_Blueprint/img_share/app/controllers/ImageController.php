<?php
class ImageController extends BaseController
{

  public function getIndex()
  {
    return View::make('tpl.index');
  }



  public function postIndex()
  {
    // Poziva Validator klasu, i proverava sve Input, po $upload_rules
    $validation = Validator::make(Input::all(), Photo::$upload_rules);

    if($validation->fails()) {
      return Redirect::to('/')
        ->withInput()
        ->withErrors($validation); // errors > ovo je build in
    } else {
      // Uzmi image podatke
      $image = Input::file('image');

      // ?? Da li je ovo laravel ili plugin
      $filename = $image->getClientOriginalName();

      // Kreiraj path, odnosno uzmi filename originala
      $filename = pathinfo($filename, PATHINFO_FILENAME);

      // Generisi novi fajl name, 213124random_name.ext
      // salted = dodati random chars
      // Str::slug = url friendly "slug"
      $fullname = Str::slug(Str::random(8).$filename).'.'.$image->getClientOriginalExtension();

      // UPLOAD
      // Premesti uplodovan img (koji je u temp folderu) u odgovarajuci folder
      // move(path, filename)
      $upload = $image->move
        (Config::get('image.upload_folder'), $fullname);

      //Image = IMAGE plugin
      // ovo kreira thumbnail image
      // Image::make(Config::get('image.upload_folder').'/'.$fullname)
      //   ->resize(Config::get('image.thumb_width'), Config::get('image.thumb_height'))
      //   ->save(Config::get('image.thumb_folder').'/'.$fullname);


      // Ukoliko je upload uspesan
      if($upload) {

        // Ubaci u DB
        // Fluent Query Builder
        //
        // Moglo je i uz pomoc Eloquent ORM
        // $picture = Photo::create(array('title' => Input::get('title'), 'image'
        // => $fullname));
        // Nakon toga id pristupamo uz pomoc: $picture->id;
        $insert_id = DB::table('photos')->insertGetId( // insertGetId >> ubacuje row i vraca njegov id
          array(
            'title' => Input::get('title'),
            'image' => $fullname
          )
        );

        // Success
        return Redirect::to(URL::to('snatch/'.$insert_id))
          ->with('success', 'Your image is uploaded successfully!');
      } else {

        // Fail
        return Redirect::to('/')
          ->withInput()
          ->with('error', 'Sorry, the image could not be uploaded.'); // error = custom message
      }

    }

  }



  // Pojedinacna slika
  public function getSnatch($id)
  {
    // Pronadji sliku iz db
    $image = Photo::find($id);

    if($image) {

      return View::make('tpl.permalink')
        ->with('image', $image); // prosledi $image za koriscenje u view

    } else {

      return Redirect::to('/')
        ->with('error', 'Image not found');
    }
  }




  // Galeri prikazi sve slike
  public function getAll()
  {

    $all_images = DB::table('photos')->orderBy('id', 'desc')->paginate(6);

    return View::make('tpl.all_images')
      ->with('images', $all_images);
  }


  public function getDelete($id)
  {
    $image = Photo::find($id);

    if($image) {
      // Delete file
      File::delete(Config::get('image.upload_folder').'/'.$image->image);
      File::delete(Config::get('image.thumb_folder').'/'.$image->image);

      // Obrisi iz db
      $image->delete();

      return Redirect::to('/')
        ->with('success', 'Image deleted successfully!');
    } else {

      return Redirect::to('/')
        ->with('error', 'No image with given ID found');
    }
  }




}
