<?php

namespace Repositories\Interfaces;
 
interface ImageInterface {
  public function findById($id);
  public function findByIdIn($in, $owner_id, $id);
  public function findAll();
  public function findAllBy($by, $owner_id);
  public function findAllIn($in);
  public function paginate($limit = null);
  public function storeIn($in, $owner_id, $data);
  public function update($id, $data);
  public function updateIn($in, $owner_id, $id, $data);
  public function destroy($id);
  public function destroyIn($in, $owner_id, $id);
  public function validation($data);
  public function instance();
}