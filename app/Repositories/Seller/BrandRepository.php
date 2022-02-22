<?php

namespace App\Repositories\Seller;

use App\Interfaces\Seller\BrandInterface;
use App\Models\BrandSelect;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;

class BrandRepository implements BrandInterface
{
   public function showBrand()
   {
      $brand = Brand::get();
      $seller = Seller::where('id', Auth::user()->id)->select('brand_id')->first();
      $selected_brand = explode(',', $seller->brand_id);
      return [$brand, $selected_brand];
   }

   public function getBrand(array $array)
   {
      $data =  Brand::where('id', $array['id'])->first();
      return $data;
   }
   public function selectedBrand(array $array)
   {
      $selected_brand_id = $array['select_id'];
      $a = implode(',', $selected_brand_id);
      $id = Auth::user()->id;
      $seller = Seller::find($id);
      $seller->brand_id = $a;
      $seller->save();
      return $seller;
   }
}
