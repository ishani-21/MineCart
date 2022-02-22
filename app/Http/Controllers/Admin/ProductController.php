<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\Models\Product;
use App\Models\Store;
use App\Models\Seller;
use App\Models\Notification;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(ProductDataTable $ProductDataTable)
    {
        return $ProductDataTable->render('Admin.product.index');
    }
    public function changeStatus(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $product->status = $request->status;
        $product->save();

        if ($product) {
            if ($product['status'] == 1) {
                $data['msg'] = 'Store Inactivated successfully.';
                $data['action'] = 'Inactivated!';
            } else {
                $data['msg'] = 'Store Activated successfully.';
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
    public function isapprove(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $product->is_approve = $request->is_approve;
        $product->save();
        $store = Store::where('id', $product->stor_id)->first();
        $seller = Seller::where('id', $store->saller_id)->first();
        $notification = new Notification;
        $notification->sender_seller_id = $seller->id;
        if ($product) {
            // 0 - pending, 1 - approve, 2 - rejected
            if ($product['is_approve'] == 2) {
                $notification->title = "Rejected Notification";
                $notification->message = "Oops 😣 !! Your ".$seller->fname." ".$seller->lname." your ".$product->en_productname." product has been Rejected ";
                $notification->save();

                $data['msg'] = 'Store Rejected successfully.';
                $data['action'] = 'Rejected!';
            } else if ($product['is_approve'] == 1) {
                $notification->title = "Approvals Notification";
                $notification->message = "".$seller->fname." ".$seller->lname." your ".$product->en_productname." product approval has been successfully recoreded 🤗";
                $notification->save();

                $data['msg'] = 'Store Approved successfully.';
                $data['action'] = 'Approved!';
            } else {
                $data['msg'] = 'Store Pending successfully.';
                $data['action'] = 'Pending!';
            }
            $data['is_approve'] = 'success';
        } else {
            $data['msg'] = 'Something went wrong';
            $data['action'] = 'Cancelled!';
            $data['is_approve'] = 'error';
        }
        return $data;
    }
    public function show($id)
    {
        $data = Product::find(decryptString($id));
        return view('Admin.product.show',compact('data'));
    }
    public function delete(Request $request)
    {
        return Product::where('id', $request->id)->delete();
    }
}
