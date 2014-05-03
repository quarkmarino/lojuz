<?php

namespace Repositories\Services\Provider;

use Illuminate\Support\ServiceProvider;

class ComposerProvider extends ServiceProvider {
 
  public function register()
  {
    $this->app->view->composer('partials.footer', 'Repositories\Composers\TweetsComposer');
  }
 
}