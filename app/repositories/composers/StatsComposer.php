<?php

namespace Repositories\Composers;

use Models;
 
class StatsComposer{
 
  public function compose($view){
  	$stats = array(
  		'news' => array(
  			'total' => Models\News::count(),
  			'visible' => Models\News::active()->count(),
  		),
  		'clients' => array(
  			'total' => Models\Client::count(),
  			'visible' => Models\Client::active()->count(),
  		),
  		'catalogs' => array(
  			'total' => Models\Catalog::count(),
  			'visible' => Models\Catalog::active()->count(),
  		),
  		'products' => array(
  			'total' => Models\Product::count(),
  			'visible' => Models\Product::active()->count(),
  		),
  		'galleries' => array(
  			'total' => Models\Gallery::count(),
  			'visible' => Models\Gallery::active()->count(),
  		),
  	);
    $view->with('stats', $stats);
  }
}