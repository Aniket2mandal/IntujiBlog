<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try{
        // dd("hello");
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }
catch(\Exception $e){
  return response()->json(['message'=> $e->getMessage()],500);
}
}
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken('Access Token')->plainTextToken;

            return response()->json(['message' => 'Login successful', 'token' => $token]);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }


public function logout(Request $request){
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Successfully logged out',
    ]);
}
}
