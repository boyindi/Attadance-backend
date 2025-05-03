<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login

    public function login(Request $request)
    {
    $loginData = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User ::where('email', $loginData['email'])->first();


    // ceck user exist
    if (!$user) {
        return response(["message" => "Invalid Credential"], 401);
    }

    // ceck password
if (!Hash::check($loginData['password'], $user->password)) {
    return response(["message" => "Invalid Credential"], 401);

}

$token = $user->createToken('auth_token')->plainTextToken;

return response(['user' => $user, 'token' => $token] , 200);
    }

    // logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logged out successfully'], 200);
    }

}



