<?php
class Category extends Eloquent
{

  protected $fillable = array('name');

  public static $rules = array('name' => 'required|min:3');

  public function products()
  {
    // Povezivanje sa Products model
    return $this->hasMany('Products');
  }

}
