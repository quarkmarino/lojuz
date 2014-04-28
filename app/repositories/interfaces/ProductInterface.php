<?php

namespace Repositories\Interfaces;
 
interface ProductInterface {
  public function findById($id);
  public function findByIdIn($catalog_id, $id);
  public function findRelated($id, $ammount);
  public function findAll();
  public function findAllBy($catalog_id);
  public function findAllOrphan();
  public function findAllRelated($id);
  public function paginate($limit = null);
  public function storeIn($catalog_id, $data);
  public function store($data);
  public function update($id, $data);
  public function destroy($id);
  public function removeFrom($catalog_id, $id);
  public function validation($data);
  public function instance();
}