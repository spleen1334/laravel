<?php
class Link extends Eloquent
{
  // Table koji se vezuje za model,
  // ovo nemora da se definise jer laravel automatski trazi plural od Link (links)
  protected $table = 'links';

  // Koja polja se mogu create & update
  // mass assignement, po defaultu je sve blockirano
  protected $fillable = array('url', 'hash');

  // ne koristi timestamps polja koja se inace automatski generisu
  public $timestamps = false;
}
