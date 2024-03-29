<?php

namespace Repositories\Interfaces;
 
interface ClientInterface {
  public function findById($id);
  public function findAll();
  public function paginate($limit = null);
  public function store($author_id, $data);
  public function update($id, $data);
  public function destroy($id);
  public function validation($data);
  public function instance();
}