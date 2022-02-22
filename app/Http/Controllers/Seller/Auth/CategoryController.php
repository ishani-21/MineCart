<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryCommission;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Repositories\Seller\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct(CategoryRepository $Category)
    {
        $this->Category = $Category;
    }

    public function showCategory()
    {
        $category = $this->Category->showCategory();
        return view('Seller.category.list', compact('category'));
    }

    public function getCategory(Request $request)
    {
        $data =  Category::where('id', $request->id)->first();
        return response()->json(['data' => $data]);
    }

    public function storeCategory(Request $request)
    {
        $data = $this->Category->storeCategory($request->all());
        return response()->json(['data' => $data]);
    }

    public function slecetCategory(Request $request)
    {
        $data = $this->Category->selectCategory($request->all());
        return  $data;
    }
}
