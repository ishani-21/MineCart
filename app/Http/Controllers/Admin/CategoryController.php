<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepositories;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use App\Http\Requests\Admin\CategoryRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $categoryrepo;

    public function __construct(Category $category)
    {
        $this->categoryrepo = new categoryRepositories($category);
    }

    public function index(CategoryDataTable $CategoryDataTable)
    {
        return $CategoryDataTable->render('Admin.Category.list');
    }

    public function create()
    {
        $parent_id = Category::where('parent_id','0')->get()->toArray();
        return view('Admin.Category.create',compact('parent_id'));
    }
    
    public function store(CategoryRequest $request)
    {
        return $this->categoryrepo->store($request->all());
    }

    public function show($id)
    {
        $data = Category::where('slug',$id)->first();
        $subcategory = Category::where('parent_id',$data->id)->get();
        return view('Admin.Category.show',compact('data','subcategory'));
    }

    public function edit($id)
    {
        $data = Category::where('slug',$id)->first();
        $parent_id = Category::where('parent_id','0')->get()->toArray();
        $subcategory = Category::where('parent_id',$data->id)->get();
        return view('Admin.Category.edit',compact('data','parent_id','subcategory'));
    }

    public function update(CategoryRequest $request,$id)
    {
        return $this->categoryrepo->update($request->all(),$id);
    }

    public function subedit(Request $request)
    {
        $data['subcategory'] = Category::find($request->id);
        $data['category'] = Category::where('parent_id','0')->get()->toArray();
        return $data;
    }

    public function subupdate(Request $request)
    {
        return $this->categoryrepo->subupdate($request->all());
    }

    public function subdelete(Request $request)
    {
        return $this->categoryrepo->subdelete($request->all());
    }

    public function catchangestatus(Request $request)
    {
        return $this->categoryrepo->catchangestatus($request->all());
    }
}
