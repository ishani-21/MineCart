<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterVerifyMail;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = "/seller/welcome";

    public function __construct()
    {
        $this->middleware('guest:seller')->except('logout');
    }

    // Google Login
    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle()
    {
        $user = Socialite::driver('google')->user();
        // Find User
        $seller = Seller::where('email', $user->email)->first();
        if ($seller) {
            Auth::guard('seller')->login($seller);
            return redirect()->route('seller.main');
        } else {
            $seller = new Seller();
            $seller->fname = $user->name;
            $seller->email = $user->email;
            $seller->social_login_id = $user->id;
            $seller->is_type = "0";
            $seller->is_verify = "1";
            $seller->password = uniqid(); // we dont need password for login
            $seller->save();
            Auth::guard('seller')->login($seller);
            return redirect()->route('seller.main');
        }
    }
    // Facebook Login
    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFacebook()
    {
        $user = Socialite::driver('facebook')->user();
        // Find User
        $seller = Seller::where('email', $user->email)->where('social_login_id', $user->id)->first();
        if ($seller) {
            Auth::guard('seller')->login($seller);
            return redirect()->route('seller.main');
        } else {
            $seller = new Seller();
            $seller->fname = $user->name;
            $seller->email = $user->email;
            $seller->social_login_id = $user->id;
            $seller->is_type = "0";
            $seller->is_verify = "1";
            $seller->password = uniqid(); // we dont need password for login
            $seller->save();
            Auth::guard('seller')->login($seller);
            return redirect()->route('seller.main');
        }
    }

    public function showLoginForm()
    {
        return view('Seller.Auth.login');
    }
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        return redirect()->route('seller.login');
    }
    protected function guard()
    {
        return Auth::guard('seller');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);
        $seller = Seller::where('email', $request->email)->first();
        // dd($seller);
        if (empty($seller)) {
            return $this->sendFailedLoginResponse($request);
        } else if ($seller->is_approve == '0') {
            return redirect()->back()->with('warning', 'Please wait Admin will Approve Your Account And send the email');
        }else if ($seller->is_approve == '2') {
            return redirect()->back()->with('warning', 'Sorry 😔 !! Your Account is Rejacted You can not login');
        } elseif ($seller['status'] == '1') {
            return redirect()->back()->with('error', 'You Can not Login Beacuse Your Account is Deactive...');
        } else {
            if (
                method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)
            ) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }
            if ($seller['is_verify'] == '1') {
                if ($this->attemptLogin($request)) {
                    if ($request->hasSession()) {
                        $request->session()->put('auth.password_confirmed_at', time());
                    }
                    return $this->sendLoginResponse($request);
                }
            } else {
                $id = $seller->id;
                $seller = Seller::find($id);
                $otp = $seller->otp = mt_rand(1000000, 9999999);
                $seller->otp = $otp;
                Mail::to($request->email)->send(new RegisterVerifyMail($otp));
                $seller = $seller->save();
                return redirect()->route('seller.varify_otp_show');
            }
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }
    }
}
