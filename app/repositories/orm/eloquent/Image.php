<?php

namespace Repositories\ORM\Eloquent;

use Repositories\Interfaces\ImageInterface;
use Repositories\Services\Validators\ImageValidator;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class Image implements ImageInterface {

  protected $validator;

  public function __construct(ImageValidator $validator){
    $this->validator = $validator;
  }

  public function findById($id){
    //$image = \Models\Image::where('id', $id)->first();
    //if(!$image) throw new NotFoundException('Image Not Found');
    $image = \Models\Image::find($id);
    if(!$image) throw new NotFoundException('Image Not Found');
    return $image;
  }

  public function findByIdIn($in = 'product', $owner_id, $id){
    //$image = \Models\Image::where('id', $id)->first();
    //if(!$image) throw new NotFoundException('Image Not Found');
    $image = \Models\Image::find($id);
    $owner = $in . '_id';
    if(!$image || $image->$owner != $owner_id) throw new NotFoundException('Image Not Found');
    return $image;
  }

  public function findAll(){
    return \Models\Image::orderBy('created_at', 'asc')
    ->paginate(15);
  }

  public function findAllBy($by = 'product', $owner_id){
    $where = 'where' . ucfirst($by) . 'Id';
    return \Models\Image::$where($owner_id)
    ->orderBy('created_at', 'desc')
    ->paginate(15);
  }

  public function findAllIn($in = 'products'){
    $owners = array('products' => 'product_id', 'catalogs' => 'catalog_id', 'galeries' => 'gallery_id');
    $image = new \Models\Image();
    foreach($owners as $owner => $fkey){
      $image = $owner === $in ? $image->whereNotNull($owners[$owner]) : $image->whereNull($owners[$owner]);
    }
    $image->orderBy('created_at', 'desc')
    ->paginate(15);
    return $image;
  }

  public function paginate($limit = null){
    return \Models\Image::paginate($limit);
  }

  /**
   * Validates and create the image resource
   * @param array $data the data with which the model will be populated
   * @return the created image model
  */

  public function storeIn($in = 'product', $owner_id, $data){
    /*$data['thumb'] = '';
    $data['minithumb'] = '';
    $data['slide'] = '';*/
    //dd($data);
    $data = array_merge(array('dirname' => '', $in . '_id' => $owner_id), $data);
    $this->validation($data);
    $image = \Models\Image::create($data);
    return $image;
  }

  /**
   * Finds the the image resource by id, validates the data, the fills the model ands save it
   * @param integer $id the id of the resource
   * @param array $data the data with which the model will be filled
   * @return the updated image model 
  */

  public function update($id, $data){
    $image = $this->findById($id);
    $this->validation($data);
    $image->fill($data);
    $image->save();
    return $image;
  }

   public function updateIn($in, $owner_id, $id, $data){
    $image = $this->findByIdIn($in, $owner_id, $id);
    $this->validation($data);
    $image->fill($data);
    $image->save();
    return $image;
  }


  /**
   * Finds the the image resource by id and deletes it
   * @param integer $id the id of the resource
   * @return the updated image model 
  */

  public function destroy($id){
    $image = $this->findById($id);
    return $image->delete();
  }

  public function destroyIn($in = 'product', $owner_id, $id){
    $image = $this->findByIdIn($in, $owner_id, $id);
    return $image->delete();
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\Image($data);
  }
  
}