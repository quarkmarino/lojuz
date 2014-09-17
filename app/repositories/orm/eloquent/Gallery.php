<?php

namespace Repositories\ORM\Eloquent;

use Repositories\Interfaces\GalleryInterface;
use Repositories\Services\Validators\GalleryValidator;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Authority\Authority as Authority;
 
class Gallery implements GalleryInterface {

  protected $validator;

  public function __construct(GalleryValidator $validator){
    $this->validator = $validator;
  }

  public function findById($id){
    $gallery = \Models\Gallery::where('id', $id)->first();
    if(!$gallery) throw new NotFoundException('Gallery Not Found');
    return $gallery;
  }

  public function findByIdActive($id){
    $gallery = \Models\Gallery::active()->whereId($id)->first();
    if(!$gallery) throw new NotFoundException('Gallery Not Found');
    return $gallery;
  }

  public function findAll(){
    return \Models\Gallery::with(array(
      'images' => function($q){
        $q->orderBy('created_at', 'desc');
      }
    ))
    ->orderBy('created_at', 'asc')
    ->paginate(15);
  }

  public function findAllActive(){
    return \Models\Gallery::active()
    ->orderBy('created_at', 'asc')
    ->get();
  }

  public function paginate($limit = null){
    return \Models\Gallery::paginate($limit);
  }

  /**
   * Validates and create the gallery resource
   * @param array $data the data with which the model will be populated
   * @return the created gallery model
  */

  public function store($author_id, $data){
    $data['user_id'] = $author_id;
    $this->validation($data);
    return \Models\Gallery::create($data);
  }

  /**
   * Finds the the gallery resource by id, validates the data, the fills the model ands save it
   * @param integer $id the id of the resource
   * @param array $data the data with which the model will be filled
   * @return the updated gallery model 
  */

  public function update($id, $data){
    $gallery = $this->findById($id);
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

  public function destroy($id){
    $gallery = $this->findById($id);
    return $gallery->delete();
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\Gallery($data);
  }
  
}