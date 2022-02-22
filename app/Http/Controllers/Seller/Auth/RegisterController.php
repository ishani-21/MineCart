<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Bussiness_register;
use App\Http\Requests\Seller\ForgotRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Seller\RegisterRequest;
use App\Mail\RegisterVerifyMail;
use App\Models\Seller;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\Seller\ProfileRequest;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('Seller.Auth.register');
    }
    public function showBusinessRegisterForm()
    {
        return view('Seller.Auth.business-register');
    }

    public function showBussinessRegisterForm()
    {
        return view('Seller.business_register');
    }

    public function varifyOtpShow()
    {
        return view('Seller.Auth.register-verify-otp');
    }

    public function individualRegister(RegisterRequest $request)
    {
        $seller = new Seller();
        $seller->fname = $request->fname;
        $seller->lname = $request->lname;
        $seller->email = $request->email;
        $seller->mobile = $request->mobile;
        $seller->address = $request->address;
        $seller->password = Hash::make($request->password);
        $seller->is_type = '0';
        $seller->is_approve = '0';
        $otp = $seller->otp = mt_rand(1000000, 9999999);
        $seller->otp = $otp;

        Mail::to($request->email)->send(new RegisterVerifyMail($otp));
        $seller->save();
        return redirect()->route('seller.varify_otp_show');
    }

    public function showEditProfile()
    {
        $country = Country::all();
        $state = State::all();
        $city = City::all();
        $data = Seller::where('id', Auth::user()->id)->first();
        return view('Seller.Auth.profile', compact('data', 'country', 'state', 'city'));
    }

    public function state(Request $request)
    {
        $country = $request->country;
        $state = State::where('country_id', $country)->get();
        return $state;
    }
    public function city(Request $request)
    {
        $state = $request->state;
        $city = City::where('state_id', $state)->get();
        return $city;
    }
    public function updateProfile(ProfileRequest $request, $id)
    {
        $seller = Seller::find($id);
        $seller->fname = $request->fname;
        $seller->lname = $request->lname;
        $seller->email = $request->email;
        $seller->mobile = $request->mobile;
        $seller->country_id = $request->country;
        $seller->state_id = $request->state;
        $seller->city_id = $request->city;
        $seller->save();
        return redirect()->route('seller.show_edit_profile');
    }

    public function businessRegister(Bussiness_register $request)
    {
        $seller = new Seller();
        $seller->bussiness_name = $request->business_name;
        $seller->email = $request->email;
        $seller->mobile = $request->mobile;
        $seller->website = $request->website;
        $seller->is_type = '1';
        $seller->register_number = $request->register_number;
        $seller->password = Hash::make($request->b_password);
        $otp = $seller->otp = mt_rand(1000000, 9999999);
        $seller->otp = $otp;
        Mail::to($request->email)->send(new RegisterVerifyMail($otp));
        $save = $seller->save();
        return response()->json(['data' => $save]);
        // if ($save) {
        //     return view('Seller.Auth.register-verify-otp');
        // } else {
        //     return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        // }
    }

    public function verifyOtp(Request $request)
    {
        $seller = Seller::where('otp', $request->otp)->first();
        if (empty($seller)) {
            return redirect()->back()->with('error', 'OTP is incorrect !!');
        } else if ($seller->otp == $request->otp) {
            $seller->is_verify = "1";
            $seller->save();
            // Auth::guard('seller')->login($seller);
            return redirect()->route('seller.login');
        } else {
            return redirect()->back()->with('error', 'OTP is incorrect !!');
        }
    }

    //forgot password
    public function showForgetPasswordForm()
    {
        return view('Seller.forgot-password');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $seller = Seller::where('email', $request['email'])->first();
        $forgot_token = Str::random(64);
        $seller->forgot_token = $forgot_token;
        $seller->save();

        Mail::send('emails.forgetPassword', ['forgot_token' => $forgot_token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($forgot_token)
    {
        return view('Seller.forgetPasswordLink', ['forgot_token' => $forgot_token]);
    }
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:sellers',
            'password' => 'required|string|min:6',
            'cpassword' => 'required|same:password'
        ]);

        $updatePassword = DB::table('sellers')
            ->where([
                'email' => $request->email,
                'forgot_token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = Seller::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        return redirect()->route('seller.login')->with('message', 'Your password has been changed!');
    }

    //change password
    public function showChangePasswordGet()
    {
        return view('Seller.change-password');
    }
    public function changePasswordPost(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new-password'
        ]);

        //Change Password

        $seller = Seller::where('id', Auth::user()->id)->first();
        $seller->password = Hash::make($request->get('new-password'));
        $seller->save();

        return redirect()->back()->with("success", "Password successfully changed!");
    }
}
