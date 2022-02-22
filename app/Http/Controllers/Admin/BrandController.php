<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Requests\Admin\BrandUpdate;
use App\Models\Brand;
use App\Repositories\BrandRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    protected $brandrepo;

    public function __construct(Brand $brand)
    {
        $this->brandrepo = new BrandRepositories($brand);
    }

    public function index(BrandDataTable $brandDataTable)
    {
        return $brandDataTable->render('Admin.Brand.index');
    }

    public function create()
    {
        return view('Admin.Brand.create');
    }

    public function store(BrandRequest $request)
    {
        return $this->brandrepo->store($request->all());
    }

    public function delete(Request $request)
    {
        $brand = Brand::find($request->id);
        $destination = public_path('storage/admin/brand/'.$brand->image);
        if(File::exists($destination))
        {
            file::delete($destination);
        }
        $brand->delete();
        return $brand;
    }

    public function changeStatus(Request $request)
    {
        return $this->brandrepo->changeStatus($request->all());
    }

    public function edit(Request $request)
    {
        $edit = Brand::where('id', $request->id)->first();
        return view('Admin.Brand.edit', compact('edit'));
    }

    public function update(BrandRequest $request)
    {
        return $this->brandrepo->update($request->all());
    }
}
