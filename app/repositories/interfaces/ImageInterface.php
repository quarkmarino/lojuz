<?php

namespace Repositories\Interfaces;
 
interface ImageInterface {
  public function findById($id);
  public function findAllByProduct($product_id);
  public function findAllByGallery($gallery_id);
  public function paginate($limit = null);
  public function store($data);
  public function update($id, $data);
  public function destroy($id);
  public function validation($data);
  public function instance();
}