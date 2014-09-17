<?php

namespace Repositories\ORM\Eloquent;

use Repositories\Interfaces\ClientInterface;
use Repositories\Services\Validators\ClientValidator;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class Client implements ClientInterface {

  protected $validator;

  public function __construct(ClientValidator $validator){
    $this->validator = $validator;
  }

  public function findById($id){
    $client = \Models\Client::whereId($id)->first();
    if(!$client) throw new NotFoundException('Client Not Found');
    return $client;
  }

  public function find($ammount = 4){
    return \Models\Client::orderBy('created_at', 'asc')
    ->limit($ammount)
    ->get();
  }

  public function findAll(){
    return \Models\Client::orderBy('created_at', 'asc')
    ->paginate(15);
  }

  public function findAllActive(){
    return \Models\Client::active()->orderBy('created_at', 'asc')
    ->get();
  }

  public function paginate($limit = null){
    return \Models\Client::paginate($limit);
  }

  /**
   * Validates and create the client resource
   * @param array $data the data with which the model will be populated
   * @return the created client model
  */

  public function store($author_id, $data){
    //dd($author_id);
    $data = array_merge(array('unique' => '', 'user_id' => $author_id), $data);
    //dd($data);
    $this->validation($data);
    return \Models\Client::create($data);
  }

  /**
   * Finds the the client resource by id, validates the data, the fills the model ands save it
   * @param integer $id the id of the resource
   * @param array $data the data with which the model will be filled
   * @return the updated client model 
  */

  public function update($id,$data){
    $client = $this->findById($id);
    $this->validation($data);
    $client->fill($data);
    $client->save();
    return $client;
  }

  /**
   * Finds the the client resource by id and deletes it
   * @param integer $id the id of the resource
   * @return the updated client model 
  */

  public function destroy($id){
    $client = $this->findById($id);
    return $client->delete();
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

  public function instance($data = array()){
    return new \Models\Client($data);
  }
  
}