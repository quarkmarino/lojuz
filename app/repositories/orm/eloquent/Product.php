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

  public function findAllByAuthor($author_id){
    return \Models\Product::byAuthor($author_id)->with(array(
      'author' => function($q){ $q->orderBy('created_at', 'desc'); },
      'images' => function($q){ $q->orderBy('created_at', 'desc'); }
    ))
    ->orderBy('created_at', 'desc')
    ->get();
  }

  public function findAll(){
    return \Models\Product::with(array(
      'messages' => function($q){ $q->orderBy('created_at', 'desc'); }
    ))
    ->orderBy('created_at', 'desc')
    ->get();
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
    return \Models\Product::create($data);
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

  /**
   * Finds the the product resource by id and deletes it
   * @param integer $id the id of the resource
   * @return the updated product model 
  */

  public function destroy($id){
    $product = $this->findById($id);
    return $product->delete();
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\Product($data);
  }
  
}