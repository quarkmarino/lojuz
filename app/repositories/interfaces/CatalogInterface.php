<?php

namespace Repositories\Interfaces;
 
interface CatalogInterface {
  public function findById($id);
  //public function findAllWith($with);
  public function findAll();
  public function paginate($limit = null);
  public function store($author_id, $data);
  public function update($id, $data);
  public function destroy($id);
  public function validation($data);
  public function instance();
}