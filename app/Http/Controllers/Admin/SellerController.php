<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SellerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Store;
use App\Models\Seller;
use App\Models\Notification;
use App\Repositories\SellerRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveMail;

class SellerController extends Controller
{
    protected $sellerrepo;

    public function __construct(Seller $seller)
    {
        $this->sellerrepo = new SellerRepositories($seller);
    }

    public function index(SellerDataTable $sellerdatatable)
    {
        return $sellerdatatable->render('Admin.Seller.index');
    }

    public function changeStatus(Request $request)
    {
        // return $this->sellerrepo->changeStatus($request->all());
        $store = Seller::where('id', $request->id)->first();
        $store->is_approve = $request->is_approve;
        $store->save();

        $notification = new Notification;
        $notification->sender_seller_id = $store->id;
        
        if ($store) {
            // 0 - pending, 1 - approve, 2 - rejected
            if ($store['is_approve'] == 2)
            {
                $notification->title = "Rejected Notification";
                $notification->message = "Oops 😣 !! Your " . $store->fname . " " . $store->lname . " has been Rejected ";
                $notification->save();

                $data['msg'] = 'Seller Rejected successfully.';
                $data['action'] = 'Rejected!';
            } else if ($store['is_approve'] == 1) {
                $notification->title = "Approvals Notification";
                $notification->message = "Your " . $store->fname . " " . $store->lname . " approval has been successfully recoreded 🤗";
                $notification->save();

                Mail::to($store->email)->send(new ApproveMail());

                $data['msg'] = 'Seller Approved successfully.';
                $data['action'] = 'Approved!';
            } else {
                $data['msg'] = 'Seller Pending successfully.';
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

    public function view($id)
    {
        $view = Seller::find($id);
        $brand = Brand::whereIn('id', explode(',', $view->brand_id))->get();
        return view('Admin.Seller.show', compact('view', 'brand'));
    }

    public function status(Request $request)
    {
        $seller = Seller::find($request['id']);
        if ($seller->status == '1') {
            $seller->status = '0';
            $request['msg'] = 'Seller Activated successfully.';
            $request['action'] = 'Activated!';
        } else {
            $seller->status = '1';
            $request['msg'] = 'Seller Inactivated successfully.';
            $request['action'] = 'Inactivated!';
        }
        $seller->save();
        return $seller;
    }
}
