<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Brand;
use App\Models\MembershipPlan;
use App\Models\Seller;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $user = User::all()->count();
        $brand = Brand::all()->count();
        $seller = Seller::all()->count();
        $store = Store::all()->count();
		$membership = MembershipPlan::all()->count();
        return view('Admin.layouts.content',compact('user','brand','seller','store','membership'));
    }

    public function changePassword()
    {
        return view('Admin.Auth.change-pass');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
			'old_password' => 'required',
			'new_password' => 'required|min:6',
            'new_pass_confirmation' =>'same:new_password',
		]);
		$id         = Auth::id();
		$selectData = Admin::where('id', $id)->first();
		$password   = $selectData->password;

		if (Hash::check($request->old_password, $password)) {
			$newPass        = bcrypt($request->new_password);
			$updatePassword = Admin::where('id', $id)->update(['password' => $newPass]);
			if ($updatePassword) {
				Auth::guard('admin')->logout();
				return redirect()->route('admin.login');
			}
			return redirect()->back()->withSuccess('Password Update Successfully...');
		} else {
			return redirect()->back()->withDanger('Old Password does not match with our database');
		}
    }
}
