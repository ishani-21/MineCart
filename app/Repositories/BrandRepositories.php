<?php

namespace App\Repositories;

use App\Interfaces\BrandInterface;
use App\Models\Brand;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\File;

class BrandRepositories implements BrandInterface
{
    public function store(array $data)
    {
        // dd($data);
        $brand = new Brand;
        $brand->en_name = $data['en_name'];
        $brand->ar_name = $data['ar_name'];

        if (isset($data['image'])) {
            $file = $data['image'];
            $extension = $file->getclientoriginalextension();
            $filename = rand() . '.' . $extension;
            $file->move('storage/admin/brand', $filename);
            $brand->image = $filename;
        } else {
            return back()->with('error', 'Image field is required !');
        }
        $brand->status = "0";
        $brand->save();
        return redirect()->route('admin.Brand.brandindex');
    }

    public function update(array $data)
    {
        $brand = Brand::find($data['id']);
        $brand->en_name = $data['en_name'];
        $brand->ar_name = $data['ar_name'];

        if (isset($data['image'])) {
            $destination = public_path('storage/admin/brand/' . $brand->image);

            if (file::exists($destination)) {
                file::delete($destination);
            }
            $file = $data['image'];
            $extension = $file->getclientoriginalextension();
            $filename = rand() . '.' . $extension;
            $file->move('storage/admin/brand', $filename);
            $brand->image = $filename;
        }
        $brand->save();
        // return redirect()->route('admin.brand.brandindex');
        // dd($data);
        // // dd('vgfyvgzasyHZS');
        // $brand = Brand::where('id', $data['id'])->update([
        //     'en_name' => $data['en_name'],
        //     'ar_name' => $data['ar_name'],

        // ]);
        $brand['route'] = "admin.Brand.brandindex";
        return $brand;
    }

    public function changeStatus(array $data)
    {
        $cat = Brand::where('id', $data['id'])->first();
        $cat->status = $data['status'];
        $cat->save();

        if ($cat) {
            if ($cat['status'] == 1) {
                $data['msg'] = 'Brand Inactivated successfully.';
                $data['action'] = 'Inactivated!';
            } else {
                $data['msg'] = 'Brand Activated successfully.';
                $data['action'] = 'Activated!';
            }
            $data['status'] = 'success';
        } else {
            $data['msg'] = 'Something went wrong';
            $data['action'] = 'Cancelled!';
            $data['status'] = 'error';
        }

        return $data;
    }
}
