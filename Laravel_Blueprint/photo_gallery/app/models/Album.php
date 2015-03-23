<?php

class Album extends Eloquent
{
  protected $table = 'albums';
  protected $fillable = array('name', 'description', 'cover_image');

  // RELACIJA SA DRUGIM MODELOM
  public function Photos()
  {
    return $this->has_many('images');
  }
}
