<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        dd(12);
        return $this->user->register($request->all());
    }
}
