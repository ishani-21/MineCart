<?php

namespace App\Repositories\Seller;

use App\Interfaces\Seller\CategoryInterface;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\CategoryCommission;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Session;

class CategoryRepository implements CategoryInterface
{
    public function showCategory()
    {
        $category = Category::where('parent_id','0')->get();
        // dd($category);
        return $category;
    }

    public function storeCategory(array $request)
    {
        CategoryCommission::where('store_id', $request['storeid'])->delete();
        $category = CategoryCommission::insert([
            'category_id' => implode(',', $request['id']),
            'commission' => implode(',', $request['commission']),
            'store_id' => $request['storeid']
        ]);

        Session::put('name', $request['storeid']);
        return $category;
    }

    public function selectCategory(array $request)
    {
        session()->forget('name');
        $category = CategoryCommission::where('store_id', $request['val'])->first();
        // dd($category);

        Session::put('name', $request['val']);
        $category_name=[];
        if($category!=null)
        {
            $category_id = explode(',', $category['category_id']);
            $category_name = Category::whereIn('id', $category_id)->get();
        }
        return $category_name;

    }
}
