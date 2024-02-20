<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'string|required|min:3',
            'email' => 'email|required',
            'password' => 'string|required|min:7'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors', $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);

        $user->save();

        $token = $user->createToken('token')->accessToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }
}
