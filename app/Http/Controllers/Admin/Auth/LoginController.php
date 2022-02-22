<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "admin/dashboard";

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        // dd(12334545);
        return view('Admin.Auth.login');
    }

    protected function attemptLogin(Request $request)
    {
        // dd($request->all());

        // if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect()->route('admin.dashboard');
        // } else {
        //     return redirect()->back()
        //         ->with('message', 'These credentials do not match our records');
        // }

        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    public function logout(Request $request)
    {
        // dd(123);
        $this->guard()->logout();
        return redirect()->route('admin.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
