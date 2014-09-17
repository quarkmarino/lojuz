<?php

namespace Repositories\ORM\Eloquent;

use Repositories\Interfaces\MessageInterface;
use Repositories\Services\Validators\MessageValidator;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;
use Authority\Authority as Authority;
use Illuminate\Database\Eloquent\ModelNotFoundException;
 
class Message implements MessageInterface {

  protected $validator;

  public function __construct(MessageValidator $validator){
    $this->validator = $validator;
  }

  public function validation($data){
    return $this->validator->validate($data); 
  }

}