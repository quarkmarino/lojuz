<?php

namespace Repositories\Interfaces;
 
interface GalleryInterface {
  public function findById($id);
  //public function findAllByAuthor($author_id);
  public function findAll();
  public function paginate($limit = null);
  public function store($author_id, $data);
  public function update($id, $data);
  public function destroy($id);
  public function validation($data);
  public function instance();
}