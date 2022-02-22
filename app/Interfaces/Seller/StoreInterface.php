<?php

namespace App\Interfaces\Seller;

interface StoreInterface
{
   public function createStore(array $array);

   public function showStore($id);

   public function editStore($id);

   public function updateStore(array $array, $id);

   public function deleteStore($id);
}
