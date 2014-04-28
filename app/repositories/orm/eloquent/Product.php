<?php

namespace Repositories\ORM\Eloquent;

use Repositories\Interfaces\ProductInterface;
use Repositories\Services\Validators\ProductValidator;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class Product implements ProductInterface {

  protected $validator;

  public function __construct(ProductValidator $validator){
    $this->validator = $validator;
  }

  public function findById($id){
    $product = \Models\Product::where('id', $id)->first();
    if(!$product) throw new NotFoundException('Product Not Found');
    return $product;
  }

  public function findByIdIn($catalog_id, $id){
    //$product = \Models\Image::where('id', $id)->first();
    //if(!$product) throw new NotFoundException('Image Not Found');
    $product = $this->findById($id);
    if(!$product || $product->catalog_id != $catalog_id) throw new NotFoundException('Product Not Found');
    return $product;
  }

  /*public function findAllByAuthor($author_id){
    return \Models\Product::byAuthor($author_id)->with(array(
      'images' => function($q){ $q->orderBy('created_at', 'desc'); }
    ))
    ->orderBy('created_at', 'desc')
    ->get();
  }

  public function findAllByCatalog($catalog_id){
    return \Models\Product::byCatalog($catalog_id)->with(array(
      'images' => function($q){ $q->orderBy('created_at', 'desc'); }
    ))
    ->orderBy('created_at', 'desc')
    ->get();
  }*/

  public function findAllRelated($id){
    $product = $this->findById($id);
    return \Models\Product::whereCatalogId($product->catalog_id)->where('id', '!=', $product->id)->with(array(
      'images' => function($q){ $q->orderBy('created_at', 'desc')->first(); }
    ))
    ->orderBy('created_at', 'asc')
    ->get();
  }

  public function findRelated($id, $ammount = 4){
    $product = $this->findById($id);
    return \Models\Product::whereCatalogId($product->catalog_id)->where('id', '!=', $product->id)->with(array(
      'images' => function($q){ $q->orderBy('created_at', 'desc')->first(); }
    ))
    ->orderBy(\DB::raw('RAND()'))
    ->limit($ammount)
    ->get();
  }

  public function findAll(){
    return \Models\Product::whereNotNull('catalog_id')->with(array(
      'images' => function($q){ $q->orderBy('created_at', 'desc'); }
    ))
    ->orderBy('created_at', 'asc')
    ->paginate(15);
  }

  public function findAllBy($catalog_id){
    return \Models\Product::whereCatalogId($catalog_id)->with(array(
      'images' => function($q){ $q->orderBy('created_at', 'desc'); }
    ))
    ->orderBy('created_at', 'asc')
    ->paginate(15);
  }

  public function findAllOrphan(){
    return \Models\Product::whereNull('catalog_id')->with(array(
      'images' => function($q){ $q->orderBy('created_at', 'desc'); }
    ))
    ->orderBy('created_at', 'asc')
    ->paginate(15);
  }

  public function paginate($limit = null){
    return \Models\Product::paginate($limit);
  }

  /**
   * Validates and create the product resource
   * @param array $data the data with which the model will be populated
   * @return the created product model
  */

  public function store($data){
    $this->validation($data);
    $product = \Models\Product::create($data);
    /*if( isset($data['catalog_id']) && !empty($data['catalog_id']) ){
      $catalog = $this->catalog->findById($data['catalog_id']);
      $catalog->products()->attach($product->id);
    }*/
    return $product;
  }

  public function storeIn($catalog_id, $data){
    $data['catalog_id'] = $catalog_id;
    $this->validation($data);
    $product = \Models\Product::create($data);
    /*if( isset($data['catalog_id']) && !empty($data['catalog_id']) ){
      $catalog = $this->catalog->findById($data['catalog_id']);
      $catalog->products()->attach($product->id);
    }*/
    return $product;
  }

  /**
   * Finds the the product resource by id, validates the data, the fills the model ands save it
   * @param integer $id the id of the resource
   * @param array $data the data with which the model will be filled
   * @return the updated product model 
  */

  public function update($id,$data){
    $product = $this->findById($id);
    $this->validation($data);
    $product->fill($data);
    $product->save();
    return $product;
  }

  public function assign($catalog_id, $id){
    $product = $this->findById($id);
    $product->catalog_id = $catalog_id;
    $product->save();
    return $product;
  }

  /**
   * Finds the the product resource by id and deletes it
   * @param integer $id the id of the resource
   * @return the updated product model 
  */

  public function destroy($id){
    $product = $this->findById($id);
    return $product->delete();
  }

  public function removeFrom($catalog_id, $id){
    $product = $this->findByIdIn($catalog_id, $id);
    $product->catalog_id = null;
    $product->save();
    return $product;
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\Product($data);
  }
  
}