<?php

namespace App\Repositories\Seller;

use App\Interfaces\Seller\StoreInterface;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreRepository implements StoreInterface
{
   public function createStore(array $array)
   {
      $store = new Store();
      $store->en_name = $array['en_name'];
      $store->ar_name = $array['ar_name'];
      $store->email = $array['email'];
      $store->en_description = $array['en_description'];
      $store->ar_description = $array['ar_description'];
      $store->saller_id = Auth::user()->id;
      $store->status = "0";
      $store->is_approve = "0";
      $store->save();
      return $store;
   }

   public function showStore($id)
   {
      $showStore = Store::where('saller_id', Auth::user()->id)->find($id);
      return $showStore;
   }

   public function editStore($id)
   {
      $showStore = Store::find($id);
      return $showStore;
   }

   public function updateStore(array $array, $id)
   {
      $data = Store::find($id);
      $data->en_name = $array['en_name'];
      $data->ar_name = $array['ar_name'];
      $data->email = $array['email'];
      $data->en_description = $array['en_description'];
      $data->ar_description = $array['ar_description'];
      $data->save();
      return $data;
   }

   public function deleteStore($id)
   {
      $store = Store::find($id);
      $product = Product::where('stor_id', $id)->delete();
      $store->delete();
      return $store;
   }
}
