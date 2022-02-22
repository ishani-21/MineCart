<?php

namespace App\Repositories\Seller;

use App\Interfaces\Seller\ProductInterface;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryCommission;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Seller;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductRepository implements ProductInterface
{
    public function all()
    {
        return Product::get();

    }
    public function create()
    {
        $store = Store::get();
        $brand = Seller::where('id', Auth::user()->id)->select('brand_id')->first();
        $brand_id = explode(',', $brand['brand_id']);
        $brand_name = brand::whereIn('id', $brand_id)->get();
        $store_id = Session::get('name');
        $category = CategoryCommission::where('store_id', $store_id)->first();
        $category_name = $subCategorys = [];
        if ($category != null) {
            $category_id = explode(',', $category['category_id']);
            $category_name = Category::whereIn('id', $category_id)->get();
            $subCategorys = Category::whereIn('parent_id', $category_id)->get();
        }
        // dd($category);
        // $category_id = [];
        // $category_name = [];
        // if(count($category) > 0)
        // {
        // $category_id = explode(',', $category[0]['category_id']);
        // $category_name = Category::whereIn('id', $category_id)->get();
        // }
        $array = [
            'store' => $store,
            'brand' => $brand_name,
            'category' => $category_name,
            'subcategory' => $subCategorys,
        ];
        return $array;
    }

    public function show($id)
    {
        $product =  Product::find($id);
        $images = ProductImage::where('product_id', $id)->get();
        return [
            'product' => $product,
            'images' => $images
        ];
    }

    public function store(array $request)
    {
        $product = new Product();
        $product->seller_id = Auth::user()->id;
        $product->stor_id = $request['store_id'];
        $product->brand_id = $request['brand_id'];
        $product->categories_id = $request['categories_id'];
        $product->en_productname = $request['en_name'];
        $product->ar_productname = $request['ar_name'];
        $product->cost_price = $request['cost_price'];
        $product->regular_price = $request['regular_price'];
        $product->sale_price = $request['sale_price'];
        $product->en_discription = $request['en_description'];
        $product->ar_discription = $request['ar_description'];
        $product->total_qty = $request['total_qty'];
        $product->available_stock = $request['available_stock'];
        $cover_image = uploadFile($request['cover_image'], 'seller/product');
        $product->cover_image = $cover_image;
        $product->save();
        $images = array();
        if ($files = $request['images']) {
            foreach ($files as $file) {
                $image = uploadFile($file, 'seller/product/images');
                ProductImage::insert([
                    'image' => $image,
                    'product_id' => $product->id,
                ]);
            }
        }

        return $product;
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $brand = Seller::where('id', Auth::user()->id)->select('brand_id')->get();
        $brand_id = explode(',', $brand[0]['brand_id']);
        $brand_name = brand::whereIn('id', $brand_id)->get();
        $store_id = Session::get('name');
        $category = CategoryCommission::where('store_id',$store_id)->first();
        $category_name=$subCategorys=[];
        if($category!=null)
        {

            $category_id = explode(',', $category['category_id']);

            $category_name = Category::whereIn('id', $category_id)->get();
            $subCategorys = Category::whereIn('parent_id', $category_id)->get();
            // dd($subCategorys);
        }
        // $category = CategoryCommission::where('store_id',$store_id)->get();
        // $category_id = [];
        // $category_name = [];
        // if(count($category) > 0)
        // {
        // $category_id = explode(',', $category[0]['category_id']);
        // $category_name = Category::whereIn('id', $category_id)->get();
        // }

        $images = ProductImage::where('product_id', $id)->get();
        $array = [
            'brand' => $brand_name,
            'category' => $category_name,
            'subCategory' => $subCategorys,
            'images' =>$images
        ];
        return [$product, $array];
    }

    public function update(array $request)
    {
        $product = Product::find($request['id']);
        if (isset($request['cover_image'])) {
            $image = $product->getRawOriginal('cover_image');
            if (file_exists(public_path('storage/seller/product/' . $image))) {
                @unlink(public_path('storage/seller/product/' . $image));
            }
            $images = uploadFile($request['cover_image'], 'seller/product');
            $product->cover_image = $images;
        } else {
            $images = $product->getRawOriginal('cover_image');
        }
        $product->brand_id = $request['brand_id'];
        $product->categories_id = $request['categories_id'];
        $product->en_productname = $request['en_name'];
        $product->ar_productname = $request['ar_name'];
        $product->cost_price = $request['cost_price'];
        $product->regular_price = $request['regular_price'];
        $product->sale_price = $request['sale_price'];
        $product->en_discription = $request['en_description'];
        $product->ar_discription = $request['ar_description'];
        $product->total_qty = $request['total_qty'];
        $product->available_stock = $request['available_stock'];
        $product->save();

        $productImages = array();
        if (isset($request['images']) &&  $request['images'] != NULL) {
            $files = $request['images'];
            foreach ($files as $file) {
                $image = uploadFile($file, 'seller/product/images');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image
                ]);
            }
        }
        return $product;
    }


    public function delete(array $request)
    {
        $product = Product::find($request['id']);
        $product->delete();
        return $product;
    }

    public function removeImages(array $request)
    {
        $images = ProductImage::where('id', $request['id'])->delete();
        return $images;
    }
}
