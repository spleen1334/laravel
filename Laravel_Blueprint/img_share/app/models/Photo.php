<?php
class Photo extends Eloquent
{
  protected $table = 'photos';
  protected $fillable = array('title', 'image');
  public $timestamps = true;

  public static $upload_rules = array(
    'title' => 'required|min:3',
    'image' => 'required|image', // |image = check MIME type
  );
}
