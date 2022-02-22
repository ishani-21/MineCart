<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function register(array $data)
    {
        dd(1);
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->mobile = $data['mobile'];
        $user->password = Hash::make($data['password']);
        $user->profile = $images;
        $user->save();
        $user->token = $user->createToken('MyApp')->accessToken;
        return response()->json([
            'data' => $user,
            'message' => 'User register successfully.'
        ]);
    }

}

