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
    $catalog = \Models\Catalog::where('id', $id)->first();
    if(!$catalog) throw new NotFoundException('Catalog Not Found');
    return $catalog;
  }

  public function findAll(){
    $authority = new Authority(\Auth::user());
    if( $authority->user()->hasRole('promoter') )
      $catalogs = \Models\Catalog::promoted();
    elseif( $authority->user()->hasRole('owner') )
      $catalogs = \Models\Catalog::owned();
    else
      $catalogs = new \Models\Catalog;

    return $catalogs->with(array(
      'messages' => function($q){ $q->orderBy('created_at', 'desc'); }
    ))
    ->orderBy('created_at', 'desc')
    ->get();
  }

  public function paginate($limit = null){
    return \Models\Catalog::paginate($limit);
  }

  /**
   * Validates and create the catalog resource
   * @param array $data the data with which the model will be populated
   * @return the created catalog model
  */

  public function store($data){
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