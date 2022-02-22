<?php

namespace App\Http\Controllers\Seller\Auth;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Seller\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Seller\product\StoreRequest;
use App\Http\Requests\Seller\product\UpdateStoreRequest;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $product;
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function index(ProductDataTable $dataTable)
    {
        // $product = $this->product->all();
        
        return $dataTable->render('Seller.product.index');
    }

    public function create()
    {
        $product = $this->product->create();
        $store = Store::where('saller_id', Auth::user()->id)->first();
        if(empty($store)){
            return redirect()->back()->with('error', 'Please Add First Store....');
        }
        // $store = $product[0];
        return view('Seller.product.create', compact('product'));
    }

    public function store(StoreRequest $request)
    {
        $product = $this->product->store($request->all());
        return response()->json(['data' => $product]);
    }

    public function show($id)
    {
        $product = $this->product->show($id);
        return view('Seller.product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->product->edit($id);
        return view('Seller.product.edit', compact('product'));
    }

    public function update(UpdateStoreRequest $request, $id)
    {
        $product = $this->product->update($request->all());
        return response()->json(['data' => $product]);
    }

    public function destroy(Request $request)
    {
        $product = $this->product->delete($request->all());
        return response()->json(['data' => $product]);
    }

    public function status(Request $request)
    {
        $id = $request['id'];
        $product = Product::find($id);

        if ($product->status == "0") {
            $product->status = "1";
        } else {
            $product->status = "0";
        }
        $product->save();
        return response()->json(['data' => $product]);
    }

    public function removeImages(Request $request)
    {
        $images = $this->product->removeImages($request->all());
        return response()->json(['data' => $images]);
    }
}
