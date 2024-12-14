<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (is_null($user)) {
            return response()->json(['message' => 'No user found'], 200);
        }
        return response()->json([$user], 200);
    }

    public function update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (is_null($user)) {
            return response()->json(['message' => 'User not found'], 200);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json(['message' => 'User updated sucessfully'], 200);
    }
}
