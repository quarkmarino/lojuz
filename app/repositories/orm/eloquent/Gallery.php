<?php

namespace Repositories\ORM\Eloquent;

use Repositories\Interfaces\GalleryInterface;
use Repositories\Services\Validators\GalleryValidator;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class Gallery implements GalleryInterface {

  protected $validator;

  public function __construct(GalleryValidator $validator){
    $this->validator = $validator;
  }

  public function findById($person_id, $id){
    $gallery = \Models\Gallery::where('id', $id)->first();
    if(!$gallery) throw new NotFoundException('Gallery Not Found');
    return $gallery;
  }

  public function findAll($person_id){
    $authority = new Authority(\Auth::user());
    if( $authority->user()->hasRole('owner') )
      $galleries = \Models\Gallery::owned();
    else
      $galleries = new \Models\Gallery;
    return $galleries->orderBy('created_at', 'desc')->get();
  }

  public function paginate($limit = null){
    return \Models\Gallery::paginate($limit);
  }

  /**
   * Validates and create the gallery resource
   * @param array $data the data with which the model will be populated
   * @return the created gallery model
  */

  public function store($person_id, $data){
    $data['person_id'] = $person_id;
    //dd($data);
    $this->validation($data);
    return \Models\Gallery::create($data);
  }

  /**
   * Finds the the gallery resource by id, validates the data, the fills the model ands save it
   * @param integer $id the id of the resource
   * @param array $data the data with which the model will be filled
   * @return the updated gallery model 
  */

  public function update($person_id, $id, $data){
    $gallery = $this->findById($person_id, $id);
    $gallery->fill($data);
    $this->validation($data);
    $gallery->save();
    return $gallery;
  }

  /**
   * Finds the the gallery resource by id and deletes it
   * @param integer $id the id of the resource
   * @return the updated gallery model 
  */

  public function destroy($person_id, $id){
    $gallery = $this->findById($person_id, $id);
    return $gallery->delete();
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\Gallery($data);
  }
  
}