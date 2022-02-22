<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\StoreDatatable;
use App\Models\Store;
use App\Models\Seller;
use App\Models\Notification;

class StoreController extends Controller
{
    public function index(StoreDatatable $StoreDatatable)
    {
        $data = request()->id;
        $data = Seller::find(decryptString($data));
        return $StoreDatatable->render('Admin.Store.index',compact('data'));
    }
    public function changeStatus(Request $request)
    {
        $store = Store::where('id', $request->id)->first();
        $store->status = $request->status;
        $store->save();

        if ($store) {
            if ($store['status'] == 1) {
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
        $store = Store::where('id', $request->id)->first();
        $store->is_approve = $request->is_approve;
        $store->save();

        $notification = new Notification;
        $notification->sender_seller_id = $store->saller_id;

        if ($store)
        {
            // 0 - pending, 1 - approve, 2 - rejected
            if ($store['is_approve'] == 2) 
            {
                
                $notification->title = "Rejected Notification";
                $notification->message = "Oops 😣 !! Your ".$store->en_name." has been Rejected ";
                $notification->save();

                $data['msg'] = 'Store Rejected successfully.';
                $data['action'] = 'Rejected!';
            }
            else if ($store['is_approve'] == 1)
            {
                $notification->title = "Approvals Notification";
                $notification->message = "Your ".$store->en_name." approval has been successfully recoreded 🤗";
                $notification->save();

                $data['msg'] = 'Store Approved successfully.';
                $data['action'] = 'Approved!';
            } else
            {
                $data['msg'] = 'Store Pending successfully.';
                $data['action'] = 'Pending!';
            }
            $data['is_approve'] = 'success';
        }
        else
        {
            $data['msg'] = 'Something went wrong';
            $data['action'] = 'Cancelled!';
            $data['is_approve'] = 'error';
        }

        return $data;
    }
    public function delete(Request $request)
    {
        return Store::where('id',$request->id)->delete();
    }
    public function show($id)
    {
        $data = Store::with('saller')->find($id);
        return view('Admin.Store.show',compact('data'));
    }
}