<?php
namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class CategoryRepositories implements CategoryInterface
{
    public function store(array $data)
    {
        $category = new Category;
        $category->en_name = $data['en_name'];
        $category->ar_name = $data['ar_name'];
        $category->commission = $data['commission'];
        $category->parent_id = $data['parent_id'];
        
        if(isset($data['image']))
        {
            $file = $data['image'];
            $extension =$file->getclientoriginalextension();
            $filename = rand().'.'.$extension;
            $file->move('storage/admin/category',$filename);
            $category->image = $filename;
        }
        else
        {
            return back()->with('error','Image field is required !');  
        }
        $category->slug = $data['en_name'];
        $category->status = "0";
        $category->save();
        return redirect()->route('admin.Category.categoryindex');
    }

    public function update(array $data,$id)
    {
        $category = Category::find($data['id']);
        $category->en_name = $data['en_name'];
        $category->ar_name = $data['ar_name'];
        $category->commission = $data['commission'];
        $category->parent_id = $data['parent_id'];

        if(isset($data['image']))
        {
            $destination = public_path('storage/admin/category/'.$category->image);
            if(file::exists($destination))
            {
                file::delete($destination);
            }
            $file = $data['image'];
            $extension =$file->getclientoriginalextension();
            $filename = rand().'.'.$extension;
            $file->move('storage/admin/category',$filename);
            $category->image = $filename;
        }
        $category->save();
        return redirect()->route('admin.Category.categoryindex');
    }

    public function subupdate(array $data)
    {
        $subcategory = Category::find($data['subcate_id']);
        $subcategory->en_name = $data['ename'];
        $subcategory->ar_name = $data['aname'];
        $subcategory->parent_id = $data['sparent_id'];
        $subcategory->commission = $data['commission'];

        if(isset($data['uploaded']))
        {
            $destination = public_path('storage/admin/category/'.$subcategory->image);
            if(file::exists($destination))
            {
                file::delete($destination);
            }
            $file = $data['uploaded'];
            $extension =$file->getclientoriginalextension();
            $filename = rand().'.'.$extension;
            $file->move('storage/admin/category',$filename);
            $subcategory->image = $filename;
        }
        
        $subcategory->save();
        return redirect()->route('admin.Category.categoryindex');
    }

    public function catchangestatus(array $data)
    {
        $category = Category::find($data['id']);
        if ($category->status == '1') {
            $category->status = '0';
            $data['msg'] = ''.$category->en_name.' category and its subcategory are fully activated.';
            $data['action'] = 'Activated!';
        } else {
            $category->status = '1';
            $data['msg'] = ' category and its subcategory are fully inactivated.';
            $data['action'] = 'Inactivated!';
        }
        $category->save();
        $cat = Category::where('parent_id',$data['id'])->get();
        foreach($cat as $c)
        {
            if ($c->status == '1') {
                $c->status = '0';
            } else {
                $c->status = '1';
            }
            $c->save();
        }
        return $data;
    }

    public function subdelete(array $data)
    {
        $subcategory = Category::find($data['id']);
        $destination = public_path('storage/admin/category/'.$subcategory->image);
        if(file::exists($destination))
        {
            file::delete($destination);
        }
        $subcategory->delete();
        return $subcategory;
    }
}
?>