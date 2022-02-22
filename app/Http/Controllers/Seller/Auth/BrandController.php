<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\BrandSelect;
use App\Models\Seller;
use App\Repositories\Seller\BrandRepository;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function __construct(BrandRepository $Brand)
    {
        $this->Brand = $Brand;
    }
    public function showBrand()
    {
        $brands = $this->Brand->showBrand();
        $brand = $brands[0];
        $selected_brand = $brands[1];
        return view('Seller.brand.list', compact('brand', 'selected_brand'));  
    }
    public function getBrand(Request $request)
    {
        $brand = $this->Brand->getBrand($request->all());
        return response()->json(['data' => $brand]);
    }

    public function selectedBrand(Request $request)
    {
        $brand = $this->Brand->selectedBrand($request->all());
        return redirect()->route('seller.brand_list', compact('brand'));
    }
}
