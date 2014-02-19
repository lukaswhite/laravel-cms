<?php namespace Lukaswhite\LaravelCms\Model;

class Page extends \Eloquent {

  const UNPUBLISHED = 0;
  const PUBLISHED = 1;
  
  /**
   * Get the user (author) who authored this page.
   *
   * @return User
   */
  public function user()
  {
  	return $this->belongsTo('User');
  }

  /**
   * Set the user (author) attribute
   *
   * @param User $user
   * @return void
   */
  public function setUserAttribute(\User $user)
  {
    $this->attributes['user_id'] = $user->id;
  }

}