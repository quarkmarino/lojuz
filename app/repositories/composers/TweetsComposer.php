<?php

namespace Repositories\Composers;
 
class TweetsComposer{
 
  public function compose($view){
  	$tweets = \Twitter::getUserTimeline(array('screen_name' => 'thujohn', 'count' => 3, 'format' => 'array'));
    $view->with('tweets', $tweets);
  }
}