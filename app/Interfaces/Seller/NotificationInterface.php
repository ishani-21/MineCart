<?php

namespace App\Interfaces\Seller;

interface NotificationInterface
{
   public function show();
   public function count();
   public function delete($id);
}
