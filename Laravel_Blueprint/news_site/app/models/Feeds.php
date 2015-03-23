<?php

Class Feeds extends Eloquent
{
  protected $table = 'feeds';
  protected $fillable = array('feed', 'title', 'active', 'category');

  protected static $form_rules = array(
    'feed' => 'required|url|active_url',
    'title' => 'required',
    'active' => 'required|between:0,1',
    'category' => 'required|in:News,Sports,Technology',
  );
}
