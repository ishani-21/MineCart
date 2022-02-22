<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $store = Store::where('saller_id', Auth::user()->id)->where('is_approve', '1')->get()->count();
        $brand = Seller::where('id', Auth::user()->id)->select('brand_id')->get();
        $selected_brand=[];
        if($brand[0]['brand_id']!=null)
        {
            $selected_brand = explode(',', $brand[0]['brand_id']);

        }
        $brandCount = (count($selected_brand));
        $category = Category::where('parent_id','0')->get()->count();
        return view('Seller.layouts.content',compact('store','brandCount','category'));
    }

    public function frontPage()
    {
        return view('Seller.Auth.frontpage');
    }
}
