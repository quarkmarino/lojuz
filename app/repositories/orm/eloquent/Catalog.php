<?php

namespace Repositories\ORM\Eloquent;

use Repositories\Interfaces\CatalogInterface;
use Repositories\Services\Validators\CatalogValidator;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class Catalog implements CatalogInterface {

  protected $validator;

  public function __construct(CatalogValidator $validator){
    $this->validator = $validator;
  }

  public function findById($id){
    $catalog = \Models\Catalog::where('id', $id)->with(array(
      'products' => function($q){ 
        $q->orderBy('created_at', 'asc');
      }
    ))
    ->first();
    if(!$catalog) throw new NotFoundException('Catalog Not Found');
    return $catalog;
  }

  /*public function findAllWith($with = 'products:images'){
    return \Models\Catalog::with(array(
      'products' => function($q){ 
        $q->orderBy('created_at', 'desc')->with(array(
            'images' => function($q){
              $q->orderBy('created_at', 'desc')->first();
            }
        ))->first();
      }
    ))
    ->orderBy('created_at', 'asc')
    ->paginate(15);
  }*/

  public function find($ammount = 4){
    return \Models\Catalog::with('image')
    ->orderBy('created_at', 'asc')
    ->limit($ammount)
    ->get();
  }

  public function findAll(){
    return \Models\Catalog::with(array(
      'products' => function($q){ 
        $q->orderBy('created_at', 'desc')->with(array(
            'images' => function($q){
              $q->orderBy('created_at', 'desc')->first();
            }
        ));
      }
    ))
    ->orderBy('created_at', 'asc')
    ->paginate(15);
  }

  public function paginate($limit = null){
    return \Models\Catalog::paginate($limit);
  }

  /**
   * Validates and create the catalog resource
   * @param array $data the data with which the model will be populated
   * @return the created catalog model
  */

  public function store($author_id, $data){
    //dd($author_id);
    $data['user_id'] = $author_id;
    $this->validation($data);
    return \Models\Catalog::create($data);
  }

  /**
   * Finds the the catalog resource by id, validates the data, the fills the model ands save it
   * @param integer $id the id of the resource
   * @param array $data the data with which the model will be filled
   * @return the updated catalog model 
  */

  public function update($id,$data){
    $catalog = $this->findById($id);
    $this->validation($data);
    $catalog->fill($data);
    $catalog->save();
    return $catalog;
  }

  /**
   * Finds the the catalog resource by id and deletes it
   * @param integer $id the id of the resource
   * @return the updated catalog model 
  */

  public function destroy($id){
    $catalog = $this->findById($id);
    return $catalog->delete();
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\Catalog($data);
  }
  
}