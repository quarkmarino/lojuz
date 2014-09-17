<?php

namespace Repositories\ORM\Eloquent;

use Repositories\Interfaces\NewsInterface;
use Repositories\Services\Validators\NewsValidator;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class News implements NewsInterface {

  protected $validator;

  public function __construct(NewsValidator $validator){
    $this->validator = $validator;
  }

  public function findById($id){
    $news = \Models\News::whereId($id)->first();
    if(!$news) throw new NotFoundException('News Not Found');
    return $news;
  }

  public function findAll(){
    return \Models\News::orderBy('created_at', 'asc')
    ->paginate(15);
  }

  public function findAllActive(){
    return \Models\News::active()
    ->orderBy('created_at', 'asc')
    ->get();
  }

  public function findLastActive(){
    return \Models\News::active()
    ->orderBy('created_at', 'desc')
    ->first();
  }

  public function paginate($limit = null){
    return \Models\News::paginate($limit);
  }

  /**
   * Validates and create the news resource
   * @param array $data the data with which the model will be populated
   * @return the created news model
  */

  public function store($author_id, $data){
    //dd($author_id);
    $data['user_id'] = $author_id;
    //dd($data);
    $this->validation($data);
    return \Models\News::create($data);
  }

  /**
   * Finds the the news resource by id, validates the data, the fills the model ands save it
   * @param integer $id the id of the resource
   * @param array $data the data with which the model will be filled
   * @return the updated news model 
  */

  public function update($id,$data){
    $news = $this->findById($id);
    $this->validation($data);
    $news->fill($data);
    $news->save();
    return $news;
  }

  /**
   * Finds the the news resource by id and deletes it
   * @param integer $id the id of the resource
   * @return the updated news model 
  */

  public function destroy($id){
    $news = $this->findById($id);
    return $news->delete();
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\News($data);
  }
  
}