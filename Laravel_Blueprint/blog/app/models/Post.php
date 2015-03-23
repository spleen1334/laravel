<?php

class Post extends Eloquent
{
  protected $table = 'posts';
  public $timestamps = true;

  protected $fillable = array('title', 'content', 'author_id');

  # POZIVA SE SA with('Author')
  # Moguce je i chainovanje:
  # with('Author')->with('Nesto')
  public function Author()
  {
    // Povezivanje sa User table
    // automatski definise user_id ukoliko nije naveden 2nd parametar
    return $this->belongsTo('User', 'author_id');
  }


}
